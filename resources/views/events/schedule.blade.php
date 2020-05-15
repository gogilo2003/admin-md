<!-- Modal -->
<div class="modal fade" id="scheduleModalLong" data-backdrop="static" tabindex="-1" role="dialog" aria-labelledby="scheduleModalLongTitle" aria-hidden="true">
	<div class="modal-dialog modal-dialog-centered" role="document">
		<div class="modal-content">
			<div class="card">
				<div class="modal-header card-header card-header-primary">
					<h5 class="modal-title" id="scheduleModalLongTitle">Add/Edit Schedule</h5>
					<button type="button" class="close" data-dismiss="modal" aria-label="Close">
						<span aria-hidden="true">&times;</span>
					</button>
				</div>
				<div class="modal-body">
					<div class="form-group">
						<label class="bmd-label-floating" for="title">Title</label>
						<input type="text" class="form-control" id="title" name="title">
					</div>
					<div class="form-group">
						<label class="bmd-label-floating" for="start_at">Start Time</label>
						<input type="time" class="form-control" id="start_at" name="start_at">
					</div>
					<div class="form-group">
						<label class="bmd-label-floating" for="end_at">End Time</label>
						<input type="time" class="form-control" id="end_at" name="end_at">
					</div>
					<div class="form-group">
						<label class="bmd-label-floating" for="content">Description</label>
						<textarea class="form-control" id="content" name="content"></textarea>
					</div>
				</div>
				<div class="modal-footer">
					<button type="button" class="btn btn-danger rounded-pill" data-dismiss="modal"><i class="material-icons">close</i> Close</button>
					<button type="button" class="btn btn-primary rounded-pill" id="saveScheduleButton"><i class="material-icons">save</i> Save Schedule</button>
				</div>
			</div>
		</div>
	</div>
</div>

@push('scripts_bottom')
	<script type="text/javascript">
		let index = 0;
		let edit = false;
		@if (isset($event))
			let schedules = @json($event->schedules);
		@else
			let schedules = [];
		@endif
		

		$(document).ready(function(){
			scheduleList();

			$('#saveScheduleButton').click(function(e){
				let item = {
					id: null,
					title: null,
					content: null,
					start_at: null,
					end_at: null,
					created_at: null,
					updated_at: null
				}

				if (edit) {
					item = schedules[index]
					setScheduleItem(item)
					schedules[index] = item
				}else{
					setScheduleItem(item)
					schedules.push(item)
				}
				edit = false
				scheduleList()
				$('#scheduleModalLong').modal('hide')
			})

			$('#scheduleModalLong').on('bs.modal.hide',function(e){
				$('#scheduleModalLong #title').val(null)
				$('#scheduleModalLong #content').val(null)
				$('#scheduleModalLong #start_at').val(null)
				$('#scheduleModalLong #end_at').val(null)
			})
		})

		setScheduleItem = function(item){
			item.title = $('#scheduleModalLong #title').val()
			item.content = $('#scheduleModalLong #content').val()
			item.start_at = $('#scheduleModalLong #start_at').val()
			item.end_at = $('#scheduleModalLong #end_at').val()
		}

		scheduleList = function(){

			$('.schedules .schedule').remove()

			schedules.forEach(function(item,i){

				let schedule = `<div class="col-md-6 schedule" id="schedule-${i}" data-id="${item.id}">
								<input type="hidden" class="form-control" id="title-${i}" value="${item.title}" name="schedules[${i}][title]">
								<input type="hidden" class="form-control" id="start_at-${i}" value="${item.start_at}" name="schedules[${i}][start_at]">
								<input type="hidden" class="form-control" id="end_at-${i}" value="${item.end_at}" name="schedules[${i}][end_at]">
								<input type="hidden" class="form-control" id="content-${i}" value="${item.content}" name="schedules[${i}][content]">
								<div class="card">
									<div class="card-body">
										<h4 class="card-title">${item.start_at}-${item.end_at} : ${item.title}</h4>
										<p class="content">${item.content}</p>
									</div>
									<div class="card-footer">
										<button data-index="${i}" type="button" class="btn btn-fab btn-outline-primary rounded-pill edit-schedule" id="edit-schedule-${i}"><i class="material-icons">edit</i></button>
										<button data-index="${i}" type="button" class="btn btn-fab btn-outline-danger rounded-pill delete-schedule"><i class="material-icons">delete</i></button>
									</div>
								</div>
							</div>`

				$(schedule).insertBefore($('#addScheduleModalButtonWrapper'))

				$('#schedule-'+i+' .card-title').html(item.start_at+"-"+item.end_at+" : "+item.title)
				$('#schedule-'+i+' .content').html(item.content)
				
				$('button.edit-schedule').click(editSchedule)
				$('button.delete-schedule').click(deleteSchedule)

			})
		}

		editSchedule = function(e){
			let i = $(this).data('index')
			let item = schedules[i]
			$('#scheduleModalLong #title').val(item.title)
			$('#scheduleModalLong #content').val(item.content)
			$('#scheduleModalLong #start_at').val(item.start_at)
			$('#scheduleModalLong #end_at').val(item.end_at)
			$('#scheduleModalLong').modal('show')
			edit = true
			index = i
		}

		deleteSchedule = function(e){
			let i = $(this).data('index')
			if (confirm("Are you sure you want to delete: "+ schedules[i].title)) {
				let id = schedules[i].id
				if(id){
					let url = '{{ route('admin-events-schedules-delete') }}'
					let data = {
						id: schedules[i].id,
						_token: '{{ csrf_token() }}'
					}
					$.post(url,data).then(response=>{
						if(response.success){
							schedules.splice(i, 1)
							scheduleList()
							$.notify({message:response.message,icon:'check_circle_outline'},{type:'success'})
						}else{
							$.notify({message:response.message,icon:'not_interested'},{type:'danger'})
						}
					})
				}else{
					schedules.splice(i, 1)
					scheduleList()
					$.notify({message:"Event schedule item removed",icon:'check_circle_outline'},{type:'danger'})
				}
				
			}
			
		}
	</script>
	
@endpush