<!-- Modal -->
<div class="modal fade" id="shedulesModal" tabindex="-1" role="dialog" aria-labelledby="manageSchedules"
    aria-hidden="true" data-backdrop="static">
    <div class="modal-dialog modal-lg modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="card card-nav-tabs">
                <div class="modal-header card-header-primary">
                    <div class="nav-tabs-navigation">
                        <div class="nav-tabs-wrapper">
                            <ul class="nav nav-tabs" data-tabs="tabs" id="daysTab"></ul>
                        </div>
                    </div>
                    <button type="button" class="btn btn-sm btn-fab btn-danger rounded-pill" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true" class="material-icons">close</span>
                    </button>
                </div>
                <div class="card-body ">
                    <div class="tab-content" id="daysTabContent"></div>
                    <hr>
                </div>
                <div class="card-footer">
                    <button type="button" class="btn btn-primary rounded-pill" data-dismiss="modal"><i class="material-icons">done_all</i> Done</button>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Modal -->
<div class="modal fade" id="addScheduleModel" tabindex="-1" role="dialog" aria-labelledby="addChedule" aria-hidden="true" data-backdrop="static">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="card">
                <div class="modal-header card-header card-header-primary">
                    <h5 class="card-title">Add Schedule</h5>
                    <button type="button" class="btn btn-sm btn-fab btn-outline-danger rounded-pill" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true" class="material-icons">close</span>
                    </button>
                </div>
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-12">
                            <div class="form-group">
                              <label for="title">Title</label>
                              <input type="text" class="form-control" name="title" id="title" aria-describedby="title" placeholder="title">
                              <small id="title" class="form-text text-muted">Title</small>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                              <label for="start_at">Start Time</label>
                              <input type="time" class="form-control" name="start_at" id="start_at" aria-describedby="startAt" placeholder="Start at">
                              <small id="startAt" class="form-text text-muted">Start Time</small>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                              <label for="end_at">End Time</label>
                              <input type="time" class="form-control" name="end_at" id="end_at" aria-describedby="endAt" placeholder="Start at">
                              <small id="endAt" class="form-text text-muted">End Time</small>
                            </div>
                        </div>
                        <div class="col-md-12">
                            <div class="form-group">
                              <label for="content">Content</label>
                              <textarea class="form-control" name="content" id="content" rows="3"></textarea>
                            </div>
                        </div>
                        <div class="col-md-12" id="speakersContainer"></div>
                    </div>
                </div>
                <div class="card-footer">
                    <button type="button" class="btn btn-danger rounded-pill" data-dismiss="modal"><i class="material-icons">close</i> Close</button>
                    <button type="button" class="btn btn-primary rounded-pill" id="saveScheduleButton"><i class="material-icons">save</i> Save</button>
                </div>
            </div>
        </div>
    </div>
</div>

@push('scripts_bottom')
    <script>
        let day_id;
        let DAYS = [];
        $('#addScheduleModel').on('show.bs.modal',event=>{
            var button = $(event.relatedTarget);

            let url = '{{ route('api-admin-events-speakers') }}'

            let data = {
                api_token: '{{ api_token() }}',
                id: event_id
            }

            $.post(url,data).then(response=>{

                if(response.success){
                    SPEAKERS = response.speakers
                    let S = ``;
                    SPEAKERS.forEach((speaker,key)=>{
                        S += `<div class="form-check form-check-inline">
                                <label class="form-check-label">
                                    <input class="form-check-input speakers" name="speakers" type="checkbox" value="${speaker.id}"> ${speaker.name}
                                    <span class="form-check-sign">
                                        <span class="check"></span>
                                    </span>
                                </label>
                            </div>`
                    })
                    document.getElementById('speakersContainer').innerHTML = S
                }
            })

        })

        $('#addScheduleModel').on('hide.bs.modal',event=>{

            $('#addScheduleModel #title').val(null)
            $('#addScheduleModel #start_at').val(null)
            $('#addScheduleModel #end_at').val(null)
            $('#addScheduleModel #content').val(null)

        })

        $('#saveScheduleButton').click(event=>{
            let url = '{{ route('api-admin-events-schedules-add') }}'

            checkboxes = document.querySelectorAll("input.speakers");
            selectedSpeakers = Array.prototype.slice.call(checkboxes).filter(ch => ch.checked==true).map(ch => parseInt(ch.value));
            // console.log(selectedSpeakers)

            let data = {
                api_token: '{{ api_token() }}',
                day_id,
                title: $('#addScheduleModel #title').val(),
                start_at: $('#addScheduleModel #start_at').val(),
                end_at: $('#addScheduleModel #end_at').val(),
                content: $('#addScheduleModel #content').val(),
                'speakers': selectedSpeakers
            }
            $.post(url,data).then(response=>{
                console.log(response)
                if (response.success) {
                    $('#addScheduleModel').modal('hide')
                } else {
                    $.notify({message:response.message},{type:'danger',z_index:9999})
                }
            })
        })

        $('#daysTab').on('show.bs.tab',event=>{
            day_id = $(event.target).data('id')
        })
        $('#shedulesModal').on('show.bs.modal', event => {
            var button = $(event.relatedTarget);
            var modal = $(this);
            event_id = button.data('event')
            // Use above variables to manipulate the DOM

            let url = '{{ route('api-admin-events-days') }}'
            let data = {
                api_token: '{{ api_token() }}',
                event_id
            }
            $.post(url,data).then(response=>{
                let tabs = document.getElementById('daysTab')
                tabs.innerHTML = null
                let tabContent = document.getElementById('daysTabContent')
                tabContent.innerHTML = null

                if (response.success) {

                    day_id = response.days.length ? response.days[0].id : null
                    DAYS = response.days

                    response.days.forEach((day,key)=>{
                        let li = document.createElement('li')
                        let a = document.createElement('a')
                        let tabPane = document.createElement('div')

                        li.className = 'nav-item'
                        li.setAttribute('role','presentation')

                        if(key==0){
                            a.className='nav-link active show'
                            tabPane.className='tab-pane active show'
                        }else{
                            a.className = 'nav-link'
                            tabPane.className = 'tab-pane'
                        }

                        let tabId = "dayTab"+day.id

                        a.setAttribute('data-id',day.id)
                        a.setAttribute('href',"#"+tabId)
                        a.setAttribute('data-toggle','tab')

                        let icon = document.createElement('span')
                        icon.className = "material-icons"
                        icon.appendChild(document.createTextNode('event_available'))

                        a.appendChild(icon)
                        a.appendChild(document.createTextNode(' '+day.title))

                        li.appendChild(a)
                        tabs.appendChild(li)

                        tabPane.setAttribute('id',tabId)

                        let h4 = document.createElement('h4')
                        h4.className='card-title text-uppercase border-bottom border-light'
                        let date = new Date(day.day)
                        h4.appendChild(document.createTextNode(day.title+':'+date.toDateString()))

                        let table = document.createElement('table')
                        table.className="table table-hover table-striped"
                        let thead = document.createElement('thead')
                        thead.innerHTML = `
                            <tr>
                                <th></th>
                                <th>Time</th>
                                <th>Title</th>
                                <th>Speakers</th>
                                <th></th>
                            </tr>
                        `
                        table.appendChild(thead)
                        let tbody = document.createElement('tbody')
                        day.event_schedules.forEach((schedule,key)=>{
                            let tr = document.createElement('tr')

                            let c1 = document.createElement('td')
                            let c2 = document.createElement('td')
                            let c3 = document.createElement('td')
                            let c4 = document.createElement('td')
                            let c5 = document.createElement('td')

                            c1.appendChild(document.createTextNode(1+key))
                            c2.appendChild(document.createTextNode(schedule.start_at + '-' + schedule.end_at))
                            c3.appendChild(document.createTextNode(schedule.title))
                            let strSpeakers = ""
                            schedule.event_speakers.forEach((speaker,key)=>{
                                strSpeakers += speaker.name + ', '
                            })
                            c4.appendChild(document.createTextNode(strSpeakers))

                            tr.appendChild(c1)
                            tr.appendChild(c2)
                            tr.appendChild(c3)
                            tr.appendChild(c4)
                            tr.appendChild(c5)
                            tbody.appendChild(tr)
                        })
                        let addButton = document.createElement('button')
                        addButton.className="btn btn-outline-primary rounded-pill"
                        addButton.setAttribute('type','button')
                        let addIcon = document.createElement('span')
                        addIcon.className = 'material-icons'
                        addIcon.appendChild(document.createTextNode('add'))

                        let text = document.createTextNode(' Add activity to '+day.title)

                        addButton.addEventListener('click',e=>{
                            $("#addScheduleModel").modal('show')
                        })

                        addButton.appendChild(icon)
                        addButton.appendChild(text)
                        table.appendChild(tbody)
                        tabPane.appendChild(h4)
                        tabPane.appendChild(table)
                        tabPane.appendChild(addButton)
                        tabContent.appendChild(tabPane)

                    })

                } else {

                }
            })

        });

        $(function () {
            $('#myTab li:last-child a').tab('show')
        })
    </script>
@endpush
