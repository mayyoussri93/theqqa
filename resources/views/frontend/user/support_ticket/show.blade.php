@extends('frontend.layouts.user_panel')

@section('panel_content')
    <div class="card">
        <div class="card-header row gutters-5">
            <div class="text-center text-md-left">
                <h5 class="mb-md-0 h5">{{ $ticket->subject }} #{{ $ticket->code }}</h5>
               <div class="mt-2">
                   <span> {{ $ticket->user->name }} </span>
                   <span class="ml-2"> {{ $ticket->created_at }} </span>
                   <span class="badge badge-inline badge-secondary ml-2"> {{ ucfirst($ticket->status) }} </span>
               </div>
            </div>
        </div>
        <div class="card-body">
            <form action="{{route('support_ticket.seller_store')}}" method="POST" enctype="multipart/form-data">
                @csrf
                <input type="hidden" name="ticket_id" value="{{$ticket->id}}" required>
                <input type="hidden" name="user_id" value="{{$ticket->user_id}}">
                <div class="form-group">
                    <textarea  name="reply" required></textarea>
                </div>
                <div class="form-group row">
                    <div class="col-md-12">
                        <div class="input-group" data-toggle="aizuploader" data-type="image" data-multiple="true">
                            <div class="input-group-prepend">
                                <div class="input-group-text bg-soft-secondary font-weight-medium">{{translate('تصفح')}}</div>
                            </div>
                            <div class="form-control file-amount">{{translate('اختار الملف')}}</div>
                            <input type="hidden" name="attachments" class="selected-files">
                        </div>
                        <div class="file-preview box sm">
                        </div>
                    </div>
                </div>
                <div class="form-group mb-0 text-right">
                    <button type="submit" class="btn btn-sm btn-primary" onclick="submit_reply('pending')">{{ translate('Send Reply') }}</button>
                </div>
            </form>
            <div class="pad-top">
                <ul class="list-group list-group-flush">
                    <li class="list-group-item px-0">
                        <div class="media">
                            <a class="media-left" href="#">
                                @if($ticket->user->avatar_original != null)
                                    <span class="avatar avatar-sm mr-3">
                                        <img src="{{ uploaded_asset($ticket->user->avatar_original) }}" onerror="this.onerror=null;this.src='{{ static_asset('assets/img/avatar-place.png') }}';"  alt="{{request()->path()}}">
                                    </span>
                                @else
                                    <span class="avatar avatar-sm mr-3">
                                        <img src="{{ static_asset('assets/img/avatar-place.png') }}"  alt="{{request()->path()}}">
                                    </span>
                                @endif
                            </a>
                            <div class="media-body">
                                <div class="comment-header">
                                    <span class="text-bold h6 text-muted">{{ $ticket->user->name }}</span>
                                    <p class="text-muted text-sm fs-11">{{ $ticket->created_at }}</p>
                                </div>
                            </div>
                        </div>
                        <div>
                            @php echo $ticket->details; @endphp
                            <br>
                            @foreach ((explode(",",$ticket->files)) as $key => $file)
                                @php $file_detail = \App\Models\Upload::where('id', $file)->first(); @endphp
                                @if($file_detail != null)
                                    <a href="{{ uploaded_asset($file) }}" download="" class="badge badge-lg badge-inline badge-light mb-1">
                                        <i class="las la-download text-muted">{{ $file_detail->file_original_name.'.'.$file_detail->extension }}</i>
                                    </a>
                                    <br>
                                @endif
                            @endforeach
                        </div>
                    </li>
                @foreach($ticket->ticketreplies->reverse()->all() as $ticketreply)
                        {{-- @if($ticket->user_id == $ticketreply->user_id)
                        @endif --}}
                        <li class="list-group-item px-0">
                            <div class="media">
                                <a class="media-left" href="#">
                                    @if($ticketreply->user->avatar_original != null)
                                        <span class="avatar avatar-sm mr-3">
                                            <img src="{{ uploaded_asset($ticketreply->user->avatar_original) }}" onerror="this.onerror=null;this.src='{{ static_asset('assets/img/avatar-place.png') }}';"  alt="{{request()->path()}}">
                                        </span>
                                    @else
                                        <span class="avatar avatar-sm mr-3">
                                            <img src="{{ static_asset('assets/img/avatar-place.png') }}"  alt="{{request()->path()}}">
                                        </span>
                                    @endif
                                </a>
                                <div class="media-body">
                                    <div class="comment-header">
                                        <span class="text-bold h6 text-muted">{{ $ticketreply->user->name }}</span>
                                        <p class="text-muted text-sm fs-11">{{$ticketreply->created_at}}</p>
                                    </div>
                                </div>
                            </div>
                            <div>
                                @php echo $ticketreply->reply; @endphp
                                <br>
                                @foreach ((explode(",",$ticketreply->files)) as $key => $file)
                                    @php $file_detail = \App\Models\Upload::where('id', $file)->first(); @endphp
                                    @if($file_detail != null)
                                        <a href="{{ uploaded_asset($file) }}" download="" class="badge badge-lg badge-inline badge-light mb-1">
                                            <i class="las la-download text-muted">{{ $file_detail->file_original_name.'.'.$file_detail->extension }}</i>
                                        </a>
                                        <br>
                                    @endif
                                @endforeach
                            </div>
                        </li>
                    @endforeach
                </ul>
            </div>
        </div>
    </div>
@endsection
@section('script')
    <script type="text/javascript">
        function submit_reply(status){
            $('input[name=status]').val(status);
            if($('textarea[name=reply]').val().length > 0){
                $('#ticket-reply-form').submit();
            }
        }

        // START CHAT SCRIPT
        $(".wrapper-msgs").animate({ scrollTop: $(".wrapper-msgs")[0].scrollHeight}, 1000);
        function sendMessage() {
            // Get text message from input.
            var newMessage = $('#chat__input').val();
            // If input is empty and tries to send message, prevent sending.

            if (newMessage == '') {
                return false;
            }
            else {
                if ({{ isset($ticket) && ($ticket != null)}}) {
                    $.post('{{ route('support_ticket.seller_store') }}', {
                        _token: '{{ @csrf_token() }}',
                        ticket_id: '{{ $ticket->id }}',
                        user_id: '{{$ticket->user_id}}',
                        reply: newMessage,
                        attachments: $('#attachment').val()
                    }, function (data) {
                        var filess = $('#attachment').val()

                        $('<div class="wrapper-media-chat"><div class="media-chat"><p>' + newMessage + '</p></div></div>').appendTo('.wrapper-msgs');
                    })
                }
                // 	// Add message as last message received in the chat list.
                $(".wrapper-msgs").stop().animate({ scrollTop: $(".wrapper-msgs")[0].scrollHeight}, 1000);

                // 	// Clear input.
                $('#chat__input').val('');
            }
        }
        $('.btn-primary').on('click', function() {
            sendMessage();
        });
        $( "#chat__input" ).keypress(function(event) {
            var keycode = (event.keyCode ? event.keyCode : event.which);
            if(keycode == '13'){
                sendMessage();
            }
        });

    </script>
@endsection
