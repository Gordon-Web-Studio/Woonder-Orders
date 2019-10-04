<?php

/**
 * Settings Modal
 *
 * This file contains the modal to can manage
 * Woonder Orders Settings.
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
	id="settingsModal"
	tabindex="-1"
	role="dialog"
	aria-labelledby="settingsModal"
	aria-hidden="true"
	>
  	<div class="modal-dialog modal-dialog-centered modal-lg" role="document">
    	<div class="modal-content">
      		<div class="modal-header">
        		<h5 class="modal-title" id="exampleModalLabel">
        			<?php echo __( 'Woonder Order Settings', $plugin_name ) ?>
        		</h5>
        		<button type="button" class="close" data-dismiss="modal" aria-label="Close">
          			<span aria-hidden="true">&times;</span>
        		</button>
      		</div>
      		<div class="modal-body">
      			<div class="row">
      				<div class="col-12" v-if="settings_error">
      					<div class="alert alert-warning alert-danger fade show" role="alert">
						  	{{ settings_error }}
						  	<button type="button" class="close" data-dismiss="alert" aria-label="Close">
						    	<span aria-hidden="true">&times;</span>
						  	</button>1
						</div>
      				</div>
					<div class="col-12 col-md-4 mb-5" v-for="setting in settings">
						<div v-if="setting.type === 'boolean'">
							<div class="form-check" v-if="setting.type === 'boolean'">
							  	<input class="form-check-input setting-field" type="checkbox" :value="setting.value" :id="setting.id" :checked="setting.value" :data-type="setting.type" @change="changeLocalSetting">
							  	<label class="form-check-label" :for="setting.id">
									{{ setting.label }}
							  	</label>
							</div>
							<small class="help-text">{{ setting.help_text }}</small>
						</div>
						<div v-else-if="setting.type === 'single_select'">
							<label :for="setting.id">{{ setting.label }}</label>
							<select :id="setting.id" class="form-control setting-field" :data-type="setting.type" @change="changeLocalSetting">
								<option
									v-for="(value, index) in setting.options"
									:value="index"
									:selected="index === setting.value.id">
										{{ value }}
								</option>
							</select>
							<small class="help-text">{{ setting.help_text }}</small>
						</div>
						<div v-else-if="setting.type === 'numeric'">
							<label :for="setting.id">{{ setting.label }}</label>
							<input :id="setting.id" type="number" class="form-control setting-field" :data-type="setting.type" @change="changeLocalSetting" :value="setting.value" min="0">
							<small class="help-text">{{ setting.help_text }}</small>
						</div>
					</div>
      			</div>
      		</div>
      		<div class="modal-footer">
		        <button type="button" class="btn btn-secondary btn-sm" data-dismiss="modal" :disabled="isLoading">
		        	{{ buttons.cancel }}
		        </button>
		        <button type="button" class="btn btn-primary btn-sm" @click="saveSettings" :disabled="isLoading">
		        	<span v-if="isLoading" class="spinner-border spinner-border-sm" role="status" aria-hidden="true"></span>
					{{ buttons.save }}
		        </button>
      		</div>
    	</div>
  	</div>
</div>
