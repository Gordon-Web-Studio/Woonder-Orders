(function( $ ) {
  'use strict';

  var woonderOrders = new Vue({
    el: '#pk-woonder-orders',

    data: {
      foo: 'bar'
    },

    computed: {

    },

    created: {

    },

    methods: {
    	openModal: function () {
    		$('.pk-woonder-modals').modal('show');
    	}
    },

    watch: {

    }
  });

})( jQuery );
