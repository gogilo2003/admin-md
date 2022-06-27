@extends('admin::layout.email')

@section('title')
    Website Feedback from {{ $data->name }}
@endsection

@section('content')
<tr>
    <td class="bg_light email-section" style="width: 100%;">
        <table role="presentation" border="0" cellpadding="0" cellspacing="0" width="100%">
            <tr>
                <td valign="middle" width="50%">
                    <table role="presentation" cellspacing="0" cellpadding="0" border="0" width="100%">
                        <tr>
                            <td class="text-services" style="text-align: left; padding-right:25px;">
                                <div class="services-list">
                                    <div class="text">
                                        <h3>Email</h3>
                                        <p>{{ $data->email }}</p>
                                    </div>
                                </div>
                                <div class="services-list">
                                    <div class="text">
                                        <h3>Phone</h3>
                                        <p>{{ clean_isdn($data->phone) }}</p>
                                    </div>
                                </div>
                                <div class="services-list">
                                    <div class="text">
                                        <h3>Name</h3>
                                        <p>{{ $data->name }}</p>
                                    </div>
                                </div>
                                <div class="services-list">
                                    <div class="text">
                                        <h3>Subject</h3>
                                        <p>{{ $data->subject }}</p>
                                    </div>
                                </div>
                            </td>
                        </tr>
                    </table>
                </td>
                <td valign="middle" width="50%">
                    <table role="presentation" cellspacing="0" cellpadding="0" border="0" width="100%">
                        <tr>
                            <td>
                                <!--<img src="{{ config('admin.path_prefix') }}/vendor/admin/img/email/about-2.jpg" alt=""
                                    style="width: 100%; max-width: 600px; height: auto; margin: auto; display: block;">-->
                            </td>
                        </tr>
                    </table>
                </td>
            </tr>
        </table>
    </td>
</tr><!-- end: tr -->
<tr>
    <td class="bg_white email-section">
        <div class="heading-section" style="text-align: justify; padding: 0 15px;">
            <p>{{ $data->comments }}</p>
        </div>
    </td>
</tr><!-- end: tr -->
<!-- 1 Column Text + Button : END -->
@endsection

