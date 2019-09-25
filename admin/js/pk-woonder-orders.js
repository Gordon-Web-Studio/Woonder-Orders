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
      }
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
    },

    watch: {

    }
  });

})( jQuery );
