(function( $ ) {
  'use strict';

  var woonderOrders = new Vue({
    el: '#pk-woonder-orders',

    data: {
    	// Status Stuffs
      customStatus: {
      	name: '',
      	description: '',
      	color: '',
      	show: true
      },
      statuses: [],
      currentStatus: {},
      // Orders stuffs
      orders: [],
      // Settings Stuffs
      settings: null,
      // Behavior Stuffs
      isLoading: false,
      buttons: {
      	save: 'Save',
      	edit: 'Edit',
      	update: 'Update',
      	cancel: 'Cancel'
      },
      // Pagination stuffs
      totalOrders: 0,
      maxNumPages: 0,
      currentPage: 1,
      paginateLoader: false
    },

    computed: {

    },

    created: function() {
    	this.loadData();
    },

    methods: {
    	/**
    	 * Load initial data
    	 *
    	 * @return {void}
    	 */
    	loadData: function () {
    		var self = this;

    		$.ajax({
    			url: '/wp-admin/admin-ajax.php',
    			method: 'get',
    			data: {
    				action: 'pk_get_index_data',
    			}
    		}).done(function(response){
    			self.statuses = response.data.initData.statuses;
    			self.orders = response.data.initData.orders;
    			self.settings = response.data.initData.settings;
    			self.currentStatus = response.data.initData.currentStatus;
    			self.totalOrders = parseInt(response.data.initData.totalOrders);
    			self.maxNumPages = parseInt(response.data.initData.maxNumPages);
    		});
    	},

    	/**
    	 * Open a Modal
    	 *
    	 * @return {void}
    	 */
    	openModal: function () {
    		$('.pk-woonder-modals').modal('show');
    	},

    	/**
    	 * Save a new custom status
    	 *
    	 * @return {void} Just save the custom status and set it to data
    	 */
    	saveCustomStatus: function () {
    		var self = this;
    		self.isLoading = true;
    		self.buttons.save = 'Saving...';

    		$.ajax({
    			url: '/wp-admin/admin-ajax.php',
    			method: 'post',
    			data: {
    				action: 'pk_create_custom_status',
    				fields: self.customStatus
    			}
    		}).done(function(response){
    			if (response.success) {
    				self.statuses.push(response.data.status);
    				self.buttons.save = 'Save';
    				self.isLoading = false;
    				$('#customStatusModal').modal('hide');
    			}
    		});
    	},

    	/**
    	 * Change the current status to can filter
    	 * the orderes
    	 *
    	 * @param  {object} status
    	 * @return {void} Just set the current status to data
    	 */
    	changeStatus: function (status) {
    		this.currentStatus = status;
    	},

    	/**
    	 * Save the settings saved from
    	 * the setting modal.
    	 *
    	 * @return {void}
    	 */
    	saveSettings: function () {
  			var self = this;
    		self.isLoading = true;
    		self.buttons.save = 'Saving...';

    		$.ajax({
    			url: '/wp-admin/admin-ajax.php',
    			method: 'post',
    			data: {
    				action: 'pk_update_settings',
    				settings: self.settings
    			}
    		}).done(function(response){
    			if (response.success) {
    				self.settings = response.data.settings;
    				self.currentStatus = self.settings.default_status_filter.value;
    				self.isLoading = false;
    				self.buttons.save = 'Save';
    				$('#settingsModal').modal('hide');
    			}
    		});
    	},

    	/**
    	 * Set and validate the settings changed
    	 * from setting form
    	 *
    	 * @param  {object} e - The event of the input/select/etc...
    	 * @return {void} Just set the right value formated to the setting fired.
    	 */
    	changeLocalSetting: function(e) {
    		if (e.target.dataset.type === 'boolean') {
    			this.settings[e.target.id].value = e.target.checked;
    		} else if (e.target.dataset.type === 'numeric') {
    			this.settings[e.target.id].value = parseInt(e.target.value);
    		} else {
    			this.settings[e.target.id].value = this.statuses.find(function(status){
    				return status.id === e.target.value;
    			});
    		}
    	},

    	/**
    	 * Get the status label and return the html formated
    	 *
    	 * @param  {string} status_label - The Status name without prefix (ex: pending)
    	 * @return {string} Return the HTML markup
    	 */
    	getStatusLabel: function (status_label) {
    		var status = this.statuses.find(function(item){
    			return item.slug === status_label;
    		});

    		return "<mark class='badge' style='background-color:"+status.color+"'><span>"+status.name+"</span></mark>";
    	},

    	/**
    	 * Get the format of an shipping address
    	 *
    	 * @param  {object} order The entire object
    	 * @param  {string} address_type The Address type to format (shipping or address)
    	 * @return {string} Return the HTML markup of the shipping address.
    	 */
    	getAddressFormat: function(order, address_type) {
    		var a = address_type === 'shipping' ? order.shipping : order.billing;
    		var address = "<strong class='d-block'>"+a.first_name+" "+a.last_name+"</strong>";
    		address = address + "<span class='d-block'> "+a.address_1+"</span>";
    		address = address + "<span class='d-block'>"+a.city+", "+a.state+", "+a.country+"</span>";
    		address = address + "<span class='d-block'>"+a.postcode+"</span>";

    		return a.first_name ? address : '';
    	},

    	/**
    	 * Method to can paginate the order
    	 *
    	 * @since  1.0.0
    	 * @param  {string} action Can be prev or next
    	 * @return {void}
    	 */
    	paginate: function(action) {
    		var self = this;
    		var page = self.currentPage;
    		this.paginateLoader = true;

    		switch (action) {
    			case "next":
    				page += 1; break;
    			case "prev":
    				page -= 1; break;
    		}

    		$.ajax({
    			url: '/wp-admin/admin-ajax.php',
    			method: 'post',
    			data: {
    				action: 'pk_get_orders',
    				args: {
    					paged: page,
    					limit: self.settings.orders_per_page.value
    				}
    			}
    		}).done(function(response){
    			if (response.success) {
    				self.currentPage = page;
    				self.orders = response.data.items;
    				self.paginateLoader = false;
    			}
    		});
    	}
    },

    watch: {

    }
  });

})( jQuery );
