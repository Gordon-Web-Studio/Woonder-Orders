(function( $ ) {
  'use strict';

  var woonderOrders = new Vue({
    el: '#pk-woonder-orders',

    data: {
    	// Status Stuffs
      customStatus: {
      	name: '',
      	description: '',
      	color: ''
      },
      statuses: [],
      currentStatus: {},
      // Orders stuffs
      orders: [],
      // Settings Stuffs
      settings: [],
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

    			if ( self.statuses.length > 0 ) {
    				self.currentStatus = self.statuses[0];
    			}
    		});
    	},

    	openModal: function () {
    		$('.pk-woonder-modals').modal('show');
    	},

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

    	changeStatus: function (status) {
    		this.currentStatus = status;
    	},

    	saveSettings: function () {
    		var settings = {};

    		$('.setting-field').each(function(){
    			settings[$(this).attr('id')] = {
    				value: $(this).val(),
    				type: $(this).attr('data-type')
    			};
    		});

    		console.log(settings);

    		$.ajax({
    			url: '/wp-admin/admin-ajax.php',
    			method: 'post',
    			data: {
    				action: 'pk_update_settings',
    				settings: settings
    			}
    		}).done(function(response){
    			if (response.success) {
    				self.settings = response.data.settings;
    			}
    		});
    	},
    },

    watch: {

    }
  });


  $(document).ready(function(){

  });

})( jQuery );
