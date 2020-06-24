<!-- Modal -->
<div class="modal fade" id="speakersModal" tabindex="-1" role="dialog" aria-labelledby="modelTitleId" aria-hidden="true" data-backdrop="static">
    <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
        <div class="modal-content">
            <div class="card">
                <div class="modal-header card-header-primary">
                    <h5 class="modal-title">Speakers</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body card-body">
                    <table class="table">
                        <thead>
                            <tr>
                                <th></th>
                                <th>Name</th>
                                <th>Email</th>
                                <th>Phone</th>
                                <th></th>
                            </tr>
                        </thead>
                        <tbody id="tbodySpeakers"></tbody>
                    </table>
                </div>
                <div class="modal-footer card-footer">
                    <button type="button" class="btn btn-danger rounded-pill" data-dismiss="modal"><i class="material-icons">close</i> Close</button>
                    <button type="button" class="btn btn-primary rounded-pill" data-toggle="modal" data-target="#addSpeakerModal">
                        <i class="material-icons">add</i>
                        Add Speaker
                    </button>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Modal -->
<div class="modal fade" id="addSpeakerModal" tabindex="-1" role="dialog" aria-labelledby="AddSpeaker" aria-hidden="true" data-backdrop="static">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="card">
                <div class="modal-header card-header-primary">
                    <h5 class="modal-title">Add Speaker</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body card-body">
                    <div class="row">
                        <div class="col-md-4">
                            <div id="img-preview" style="height: 130px; background-size: cover"></div>
                            <div class="form-group">
                              <label class="custom-file">
                                <input type="file" name="photo" id="photo" placeholder="Browse to select picture" class="custom-file-input" aria-describedby="file">
                                <span class="custom-file-control btn btn-primary btn-sm rounded-pill btn-block"><i class="material-icons">search</i> BROWSE</span>
                              </label>
                              <small id="file" class="form-text text-muted"></small>
                            </div>
                        </div>
                        <div class="col-md-8">
                            <div class="form-group">
                              <label for="name" class="bmd-label-floating">Name</label>
                              <input type="text" class="form-control" name="name" id="name" aria-describedby="name" >
                              <small id="name" class="form-text text-muted"></small>
                            </div>
                            <div class="form-group">
                              <label for="email" class="bmd-label-floating">Email</label>
                              <input type="text" class="form-control" name="email" id="email" aria-describedby="email" ">
                              <small id="email" class="form-text text-muted"></small>
                            </div>
                            <div class="form-group">
                              <label for="phone" class="bmd-label-floating">Phone</label>
                              <input type="text" class="form-control" name="phone" id="phone" aria-describedby="phone" ">
                              <small id="phone" class="form-text text-muted"></small>
                            </div>
                        </div>
                        <div class="col-md-12">
                            <div class="form-group">
                              <label for="facebook" class="bmd-label-floating">Facebook</label>
                              <input type="text" class="form-control" name="facebook" id="facebook" aria-describedby="facebook" ">
                              <small id="facebook" class="form-text text-muted"></small>
                            </div>
                            <div class="form-group">
                              <label for="twitter" class="bmd-label-floating">Twitter</label>
                              <input type="text" class="form-control" name="twitter" id="twitter" aria-describedby="twitter" ">
                              <small id="twitter" class="form-text text-muted"></small>
                            </div>
                            <div class="form-group">
                              <label for="linkedin" class="bmd-label-floating">Linkedin</label>
                              <input type="text" class="form-control" name="linkedin" id="linkedin" aria-describedby="linkedin" ">
                              <small id="linkedin" class="form-text text-muted"></small>
                            </div>
                            <div class="form-group">
                              <label for="youtube" class="bmd-label-floating">Youtube</label>
                              <input type="text" class="form-control" name="youtube" id="youtube" aria-describedby="youtube" ">
                              <small id="youtube" class="form-text text-muted"></small>
                            </div>
                            <div class="form-group">
                              <label for="instagram" class="bmd-label-floating">Instagram</label>
                              <input type="text" class="form-control" name="instagram" id="instagram" aria-describedby="instagram" ">
                              <small id="instagram" class="form-text text-muted"></small>
                            </div>
                            <div class="form-group">
                              <label for="details">Details</label>
                              <textarea class="form-control" name="details" id="details" rows="3"></textarea>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer card-footer">
                    <button type="button" class="btn btn-danger rounded-pill" data-dismiss="modal"><i class="material-icons">cancel</i> Cancel</button>
                    <button type="button" class="btn btn-primary rounded-pill" id="save"><i class="material-icons">save</i> Save</button>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Edit Speaker Modal -->
<div class="modal fade" id="editSpeakerModal" tabindex="-1" role="dialog" aria-labelledby="EditSpeaker" aria-hidden="true" data-backdrop="static">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="card">
                <div class="modal-header card-header-primary">
                    <h5 class="modal-title">Edit Speaker</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body card-body">
                    <div class="row">
                        <div class="col-md-4">
                            <div id="img-preview" style="height: 130px; background-size: cover"></div>
                            <div class="form-group">
                              <label class="custom-file">
                                <input type="file" name="photo" id="photo" placeholder="Browse to select picture" class="custom-file-input" aria-describedby="file">
                                <span class="custom-file-control btn btn-primary btn-sm rounded-pill btn-block"><i class="material-icons">search</i> BROWSE</span>
                              </label>
                              <small id="file" class="form-text text-muted"></small>
                            </div>
                        </div>
                        <div class="col-md-8">
                            <div class="form-group">
                              <label for="name" class="bmd-label-floating">Name</label>
                              <input type="text" class="form-control" name="name" id="name" aria-describedby="name" >
                              <small id="name" class="form-text text-muted"></small>
                            </div>
                            <div class="form-group">
                              <label for="email" class="bmd-label-floating">Email</label>
                              <input type="text" class="form-control" name="email" id="email" aria-describedby="email" ">
                              <small id="email" class="form-text text-muted"></small>
                            </div>
                            <div class="form-group">
                              <label for="phone" class="bmd-label-floating">Phone</label>
                              <input type="text" class="form-control" name="phone" id="phone" aria-describedby="phone" ">
                              <small id="phone" class="form-text text-muted"></small>
                            </div>
                        </div>
                        <div class="col-md-12">
                            <div class="form-group">
                              <label for="facebook" class="bmd-label-floating">Facebook</label>
                              <input type="text" class="form-control" name="facebook" id="facebook" aria-describedby="facebook" ">
                              <small id="facebook" class="form-text text-muted"></small>
                            </div>
                            <div class="form-group">
                              <label for="twitter" class="bmd-label-floating">Twitter</label>
                              <input type="text" class="form-control" name="twitter" id="twitter" aria-describedby="twitter" ">
                              <small id="twitter" class="form-text text-muted"></small>
                            </div>
                            <div class="form-group">
                              <label for="linkedin" class="bmd-label-floating">Linkedin</label>
                              <input type="text" class="form-control" name="linkedin" id="linkedin" aria-describedby="linkedin" ">
                              <small id="linkedin" class="form-text text-muted"></small>
                            </div>
                            <div class="form-group">
                              <label for="youtube" class="bmd-label-floating">Youtube</label>
                              <input type="text" class="form-control" name="youtube" id="youtube" aria-describedby="youtube" ">
                              <small id="youtube" class="form-text text-muted"></small>
                            </div>
                            <div class="form-group">
                              <label for="instagram" class="bmd-label-floating">Instagram</label>
                              <input type="text" class="form-control" name="instagram" id="instagram" aria-describedby="instagram" ">
                              <small id="instagram" class="form-text text-muted"></small>
                            </div>
                            <div class="form-group">
                              <label for="details">Details</label>
                              <textarea class="form-control" name="details" id="details" rows="3"></textarea>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer card-footer">
                    <button type="button" class="btn btn-danger rounded-pill" data-dismiss="modal"><i class="material-icons">cancel</i> Cancel</button>
                    <button type="button" class="btn btn-primary rounded-pill" id="save"><i class="material-icons">save</i> Save</button>
                </div>
            </div>
        </div>
    </div>
</div>

@push('scripts_bottom')
    <script>

        var event_id;
        var speaker_id;
        var speaker_index;
        var SPEAKERS = [];

        $('#speakersModal').on('show.bs.modal',function(e){
            let button = $(e.relatedTarget);
            let modal = $(this);
            let url = '{{ route('api-admin-events-speakers') }}'
            event_id = button.data('event')
            let data = {
                "api_token":'{{ api_token() }}',
                "id": event_id
            }

            $.post(url, data).then(res=>{
                SPEAKERS = res.speakers;
                setSpeakers(SPEAKERS)
            })
        })

        $('#addSpeakerModal #photo').change(e=>{
            // console.log(e.target.files[0])
            $('#addSpeakerModal #img-preview').css('background-image','url('+URL.createObjectURL(e.target.files[0])+')')
        })

        $('#addSpeakerModal #save').click(e=>{

            let url = '{{ route('api-admin-events-speakers-add') }}'

            let data = new FormData()

            data.append('api_token', '{{ api_token() }}')
            data.append('id', event_id)
            data.append('name', $('#addSpeakerModal #name').val())
            data.append('email', $('#addSpeakerModal #email').val())
            data.append('phone', $('#addSpeakerModal #phone').val())
            data.append('facebook', $('#addSpeakerModal #facebook').val())
            data.append('twitter', $('#addSpeakerModal #twitter').val())
            data.append('linkedin', $('#addSpeakerModal #linkedin').val())
            data.append('youtube', $('#addSpeakerModal #youtube').val())
            data.append('instagram', $('#addSpeakerModal #instagram').val())
            data.append('description', $('#addSpeakerModal #details').val())
            data.append('photo', document.querySelector('#addSpeakerModal #photo').files[0])

            $.post(
                {
                    url,
                    data,
                    processData: false,
                    contentType: false,
                }
            ).then(
                response=>{
                    if(response.success){
                        $('#addSpeakerModal').modal('hide')
                        SPEAKERS.push(response.speaker)
                        setSpeakers(SPEAKERS)
                    }else{
                        $.notify({message:response.message},{type:'danger',z_index:9999})
                    }
                }
            )

        })

        $('#editSpeakerModal').on('show.bs.modal',function(e){
            // console.log('Edit speaker opened')
            let button = $(e.relatedTarget);
            speaker_index = button.data('index')
            let speaker = SPEAKERS[speaker_index]
            // console.log(speaker)
            speaker_id = speaker.id
            $('#editSpeakerModal #name').val(speaker.name)
            $('#editSpeakerModal #name').change()
            $('#editSpeakerModal #email').val(speaker.email)
            $('#editSpeakerModal #email').change()
            $('#editSpeakerModal #phone').val(speaker.phone)
            $('#editSpeakerModal #phone').change()
            $('#editSpeakerModal #facebook').val(speaker.facebook)
            $('#editSpeakerModal #facebook').change()
            $('#editSpeakerModal #twitter').val(speaker.twitter)
            $('#editSpeakerModal #twitter').change()
            $('#editSpeakerModal #linkedin').val(speaker.linkedin)
            $('#editSpeakerModal #linkedin').change()
            $('#editSpeakerModal #youtube').val(speaker.youtube)
            $('#editSpeakerModal #youtube').change()
            $('#editSpeakerModal #instagram').val(speaker.instagram)
            $('#editSpeakerModal #instagram').change()
            $('#editSpeakerModal #details').val(speaker.description)
            $('#editSpeakerModal #details').change()
            $('#editSpeakerModal #img-preview').css('background-image','url({{ url('images/events/speakers/') }}/'+speaker.photo+')')
        })

        $('#editSpeakerModal #save').click(e=>{

            let url = '{{ route('api-admin-events-speakers-edit') }}'

            let data = new FormData()

            data.append('api_token', '{{ api_token() }}')
            data.append('event_id', event_id)
            data.append('id', speaker_id)
            data.append('name', $('#editSpeakerModal #name').val())
            data.append('email', $('#editSpeakerModal #email').val())
            data.append('phone', $('#editSpeakerModal #phone').val())
            data.append('facebook', $('#editSpeakerModal #facebook').val())
            data.append('twitter', $('#editSpeakerModal #twitter').val())
            data.append('linkedin', $('#editSpeakerModal #linkedin').val())
            data.append('youtube', $('#editSpeakerModal #youtube').val())
            data.append('instagram', $('#editSpeakerModal #instagram').val())
            data.append('description', $('#editSpeakerModal #details').val())
            if(document.querySelector('#editSpeakerModal #photo').files.length){
                data.append('photo', document.querySelector('#editSpeakerModal #photo').files[0])
            }

            $.post(
                {
                    url,
                    data,
                    processData: false,
                    contentType: false,
                }
            ).then(
                response=>{
                    if(response.success){
                        $('#editSpeakerModal').modal('hide')
                        SPEAKERS[speaker_index] = response.speaker
                        setSpeakers(SPEAKERS)
                    }else{
                        $.notify({message:response.message},{type:'danger',z_index:9999})
                    }
                }
            )

        })

        setSpeakers = (speakers)=>{
            let tbody = document.getElementById('tbodySpeakers');
            tbody.innerHTML = null
            // console.log(speakers)
            speakers.forEach((speaker,key)=>{
                // console.info(speaker)
                let tr = document.createElement('tr')
                let c1 = document.createElement('td')
                let c2 = document.createElement('td')
                let c3 = document.createElement('td')
                let c4 = document.createElement('td')
                let c5 = document.createElement('td')

                c1.innerHTML = speaker.id
                c2.innerHTML = speaker.name
                c3.innerHTML = speaker.email
                c4.innerHTML = speaker.phone
                c5.innerHTML = `<button type="button" class="btn btn-fab btn-primary rounded-pill" data-index='${key}'' data-toggle="modal" data-target="#editSpeakerModal"><span class="material-icons">edit</span></button>`

                tr.appendChild(c1)
                tr.appendChild(c2)
                tr.appendChild(c3)
                tr.appendChild(c4)
                tr.appendChild(c5)

                tbody.appendChild(tr)
            })
        }

    </script>
@endpush
