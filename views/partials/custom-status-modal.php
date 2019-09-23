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
				<div class="form-group">
			    	<label for="custom-status-name">Name</label>
			    	<input v-model="customStatus.name" type="text" class="form-control" id="custom-status-name" aria-describedby="customStatusNameHelp" placeholder="ex:. Waiting a response.">
			  	</div>
			  	<div class="form-group">
			    	<label for="custom-status-description">Description</label>
			    	<textarea v-model="customStatus.description" id="custom-status-description" class="form-control" placeholder="ex:. Status to can handle the response status"></textarea>
			  	</div>
			  	<div class="form-group">
					<input v-model="customStatus.color" id="custom-status-color" type="text" class="pk-color-field" value="#00AABB" class="form-control" data-default-color="#000000" />
			  	</div>
      		</div>
      		<div class="modal-footer">
		        <button type="button" class="btn btn-secondary btn-sm" data-dismiss="modal" :disabled="isLoading">
		        	{{ buttons.cancel }}
		        </button>
		        <button type="button" class="btn btn-primary btn-sm" @click="saveCustomStatus" :disabled="isLoading">
		        	<span v-if="isLoading" class="spinner-border spinner-border-sm" role="status" aria-hidden="true"></span>
					{{ buttons.save }}
		        </button>
      		</div>
    	</div>
  	</div>
</div>
