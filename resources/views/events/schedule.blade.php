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
                    <button type="button" class="close text-danger" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
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

@push('scripts_bottom')
    <script>
        $('#daysTab').on('show.bs.tab',event=>{
            // console.log(event.target)
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

                        // <li class="nav-item">
                        //     <a class="nav-link active show" href="#profile" data-toggle="tab">
                        //         <i class="material-icons">face</i>
                        //         Profile
                        //     </a>
                        // </li>

                        // <div class="tab-pane active show" id="profile">
                        //     <p> I will be the leader of a company that ends up being worth billions of dollars, because
                        //         I got the answers. I understand culture. I am the nucleus. I think that’s a
                        //         responsibility that I have, to push possibilities, to show people, this is the level
                        //         that things could be at. I think that’s a responsibility that I have, to push
                        //         possibilities, to show people, this is the level that things could be at. </p>
                        // </div>

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

                            c1.appendChild(document.createTextNode(1+key))
                            c2.appendChild(document.createTextNode(schedule.start_at + '-' + schedule.end_at))
                            c3.appendChild(document.createTextNode(schedule.title))

                            tr.appendChild(c1)
                            tr.appendChild(c2)
                            tr.appendChild(c3)
                            tr.appendChild(c4)
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
                            console.log(e.target)
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
