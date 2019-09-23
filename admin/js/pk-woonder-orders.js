(function( $ ) {
  'use strict';

  var woonderOrders = new Vue({
    el: '#pk-woonder-orders',

    data: {
      isLoading: false,
      customStatus: {
      	name: '',
      	description: '',
      	color: ''
      },
      customStatuses: [],
      buttons: {
      	save: 'Save',
      	edit: 'Edit',
      	update: 'Update',
      	cancel: 'Cancel'
      }
    },

    computed: {

    },

    created: {

    },

    methods: {
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
    				action: 'pk_create_order',
    				fields: self.customStatus
    			}
    		}).done(function(response){
    			if (response.success) {
    				debugger;
    				self.customStatuses.push(response.data.customStatus);
    				self.buttons.save = 'Save';
    				self.isLoading = false;
    				$('#customStatusModal').modal('hide');
    			}
    		});
    	},
    },

    watch: {
    	customStatus: {
    		deep: true,
    		handler: function (val) {
    			console.log(val);
    		}
    	}
    }
  });


  $(document).ready(function(){
	  // $('#custom-status-color').on('input', function(){
	  // 	debugger;
	  // 	woonderOrders.customStatus.color = $(this).val();
	  // });
  });

})( jQuery );
