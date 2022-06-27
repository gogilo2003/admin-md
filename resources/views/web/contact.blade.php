@extends('admin::web.layout.main')

@section('content')
<section class="container">
	<form id="contact-form" method="post" action="{{route('post-contact')}}" role="form" accept-charset="UTF-8" enctype="multipart/form-data">
		<div class="form-group{!! $errors->has('name') ? ' has-error':'' !!}">
			<label for="name">Name</label>
			<input type="text" class="form-control" id="name" name="name" placeholder="Enter name"{!! ((old('name')) ? ' value="'.old('name').'"' : '') !!}>
			{!! $errors->has('name') ? '<span class="text-danger">'.$errors->first('name').'</span>' : '' !!}
		</div>
		<div class="form-group{!! $errors->has('email') ? ' has-error':'' !!}">
			<label for="email">Email</label>
			<input type="text" class="form-control" id="email" name="email" placeholder="Enter email"{!! ((old('email')) ? ' value="'.old('email').'"' : '') !!}>
			{!! $errors->has('email') ? '<span class="text-danger">'.$errors->first('email').'</span>' : '' !!}
		</div>

		<div class="form-group{!! $errors->has('phone') ? ' has-error':'' !!}">
			<label for="phone">Phone</label>
			<input type="text" class="form-control" id="phone" name="phone" placeholder="Enter phone"{!! ((old('phone')) ? ' value="'.old('phone').'"' : '') !!}>
			{!! $errors->has('phone') ? '<span class="text-danger">'.$errors->first('phone').'</span>' : '' !!}
		</div>
		<div class="form-group{!! $errors->has('subject') ? ' has-error':'' !!}">
			<label for="subject">Subject</label>
			<input type="text" class="form-control" id="subject" name="subject" placeholder="Enter subject"{!! ((old('subject')) ? ' value="'.old('subject').'"' : '') !!}>
			{!! $errors->has('subject') ? '<span class="text-danger">'.$errors->first('subject').'</span>' : '' !!}
		</div>
		<div class="form-group{!! $errors->has('comments') ? ' has-error':'' !!}">
			<label for="comments">Message</label>
			<textarea type="text" class="form-control" id="comments" name="comments" placeholder="Enter message">{!! ((old('comments')) ? ' value="'.old('comments').'"' : '') !!}</textarea>
			{!! $errors->has('comments') ? '<span class="text-danger">'.$errors->first('comments').'</span>' : '' !!}
		</div>
		<div class="message">
			
		</div>
		<input type="hidden" name="_token" value="{{csrf_token()}}">
		<button type="submit" class="btn btn-primary"><span class="glyphicon glyphicon-floppy-disk"></span>  Save</button>
	</form>
</section>
@endsection

@push('styles')
	<style type="text/css">
		.message{
			padding: 1rem 2rem;
			text-align: center;
		}
	</style>
@endpush

@push('scripts_bottom')
    <script>
        $("#contact-form").submit(function(event) {
            event.preventDefault();

            var formData = $("#contact-form").serialize();

            $.post($("#contact-form").attr('action'),formData).then(response=>{
                let message = document.querySelector("div.message")
                message.style.display = "block"

                if(response.success){
                    message.innerHTML = response.message
                    message.classList.remove("error")
                    message.classList.add("success")
                    $("#contact-form").trigger("reset")
                }else{
                    message.classList.add("error")
                    message.classList.remove("success")
                    message.innerHTML = response.message
                }
            })
        });
    </script>
@endpush