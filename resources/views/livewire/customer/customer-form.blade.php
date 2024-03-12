<div class="modal-content">
	<div class="modal-header">
		<h1 class="modal-title fs-5">
			@if ($customerId)
			Edit Customer
			@else
			Add Customer
			@endif
		</h1>
		<button type="button" class="btn-close btn-sm" data-bs-dismiss="modal" aria-label="Close"></button>
	</div>
	@if ($errors->any())
	{{ implode('', $errors->all('<div>:message</div>')) }}
	@endif
	<form wire:submit.prevent="store" enctype="multipart/form-data">
		<div class="modal-body">
			<div class="row">
				<div class="col-md-12">
					<div class="form-group local-forms">
						<label>
							First Name
							<span class="login-danger">*</span>
						</label>
						<input class="form-control" type="text" wire:model="first_name" placeholder />
					</div>
				</div>

                <div class="col-md-12">
					<div class="form-group local-forms">
						<label>
							Middle Name
							<span class="login-danger">*</span>
						</label>
						<input class="form-control" type="text" wire:model="middle_name" placeholder />
					</div>
				</div>

                <div class="col-md-12">
					<div class="form-group local-forms">
						<label>
							Last Name
							<span class="login-danger">*</span>
						</label>
						<input class="form-control" type="text" wire:model="last_name" placeholder />
					</div>
				</div>

                <div class="col-md-12">
					<div class="form-group local-forms">
						<label>Gender
							<span class="login-danger">*</span>
						</label>
						<select class="form-control select" wire:model="gender_id">
							<option value=""  selected>Select a Gender</option>
							@foreach ($genders as $gender)
							<option value="{{ $gender->id }}">
								{{ $gender->name }}
							</option>
							@endforeach
						</select>
					</div>
				</div>
			</div>
			<div class="modal-footer">
				<button type="submit" class="btn btn-primary">Save</button>
			</div>
	</form>
</div>