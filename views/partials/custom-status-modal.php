<?php

/**
 * Custom Status Modal
 *
 * This file contains the modal to can create a
 * custom status
 *
 * @link       https://github.com/dgaitan
 * @since      1.0.0
 *
 * @package    Pk_Woonder_Orders
 * @subpackage Pk_Woonder_Orders/views/partials
 */
?>

<!-- Modal -->
<div
	class="modal fade"
	id="customStatusModal"
	tabindex="-1"
	role="dialog"
	aria-labelledby="customStatusModal"
	aria-hidden="true"
	>
  	<div class="modal-dialog modal-dialog-centered" role="document">
    	<div class="modal-content">
      		<div class="modal-header">
        		<h5 class="modal-title" id="exampleModalLabel">
        			<?php echo __( 'Add Custom Status', $plugin_name ) ?>
        		</h5>
        		<button type="button" class="close" data-dismiss="modal" aria-label="Close">
          			<span aria-hidden="true">&times;</span>
        		</button>
      		</div>
      		<div class="modal-body">

      		</div>
      		<div class="modal-footer">
		        <button type="button" class="btn btn-secondary btn-sm" data-dismiss="modal">
		        	<?php echo __( 'Cancel', $plugin_name ) ?>
		        </button>
		        <button type="button" class="btn btn-primary btn-sm">
		        	<?php echo __( 'Save', $plugin_name ) ?>
		        </button>
      		</div>
    	</div>
  	</div>
</div>
