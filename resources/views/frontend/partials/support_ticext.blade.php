<div class="tab-content p-0">
    <div class="tab-pane fade show active" id="chat1" aria-labelledby="chat1-tab">
        <div class=" chatTop">
            <h6> {{$ticket->subject}} </h6>
        </div>
        <div class=" chatBox ">
            <div class=" chatBody">
                <div class="userSend">
                    <div class="sendMassage">
                        <p> {{$ticket->details}} </p>
                        <div class=" time">
                            <span>  {{ \Carbon\Carbon::createFromFormat('Y-m-d H:i:s',$ticket->created_at)->format('F d,Y')}}</span>
                        </div>
                        @if($ticket->files != null)
                            <a href="{{ uploaded_asset($ticket->files) }}" class="badge badge-lg badge-inline badge-light mb-1">
                                <img   alt="{{request()->path()}}" src="{{ uploaded_asset($ticket->files) }}"  style="border-radius:0;height: 200px;object-fit: contain;width: 100px;">
                            </a>
                            <br>
                        @endif
                        </div>


                </div>
                @foreach($ticket->ticketreplies->reverse() as $ticketreply)
                    @if($ticket->user_id == $ticketreply->user_id)
                <div class="userSend">
                    <div class="sendMassage">
                        <p> {{$ticketreply->reply}} </p>
                        <div class=" time">
                            <span>  {{ \Carbon\Carbon::createFromFormat('Y-m-d H:i:s',$ticketreply->created_at)->format('F d,Y')}}</span>
                        </div>
                        @if($ticketreply->files != null)
                            <a href="{{ uploaded_asset($ticketreply->files) }}" >
                                <img  alt="{{request()->path()}}" src="{{ uploaded_asset($ticketreply->files) }}" style="height: 200px;object-fit: contain;width: 100px;">
                            </a>
                            <br>
                        @endif
                    </div>
                </div>
                    @else
                <div class="userReceive">
                    <div class="sendMassage">
                        <p>{{$ticketreply->reply}}  </p>
                        <div class=" time">
                            <span> {{ \Carbon\Carbon::createFromFormat('Y-m-d H:i:s',$ticketreply->created_at)->format('F d,Y')}}</span>
                        </div>
                        @if($ticketreply->files != null)
                            <a href="{{ uploaded_asset($ticketreply->files) }}" >
                                <img src="{{ uploaded_asset($ticketreply->files) }}"  style="height: 200px;object-fit: contain;width: 100px;">
                            </a>
                            <br>
                        @endif
                    </div>
                </div>
                    @endif
                @endforeach
            </div>
            <div class="chat-input ">
                <form action="{{route('support_ticket.seller_store')}}" method="POST" id="ticket-reply-for" enctype="multipart/form-data">
                    @csrf
                    <input type="hidden" name="ticket_id" value="{{$ticket->id}}" required>
                    <input type="hidden" name="user_id" value="{{$ticket->user_id}}">
                    <input type="text"  name="reply"  id="chat-input"  placeholder="ارسل رسالة ..." required />
{{--                    <input type="file" class="btn btn-circle btn-icon " name="reply"  id="chat-input"  placeholder="ارسل رسالة ..." />--}}
{{--                    <input class="form-control form-control-sm" name="attachment" id="attachment" type="file">--}}
                    <button type="submit" class="chat-submit" id="chat-submit"><i
                                class="fas fa-paper-plane"></i></button>
                </form>
            </div>

        </div>
    </div>
</div>





    <!-- chat -->
    <script>
        $(function () {
            var INDEX = 0;
            $("#chat-submit").click(function (e) {
                e.preventDefault();
                var msg = $("#chat-input").val();
                if (msg.trim() == '' && $('#attachment').val()=='') {
                    return false;
                }


                $.post('{{ route('support_ticket.seller_store') }}', {_token:'{{ @csrf_token() }}', ticket_id:'{{ $ticket->id }}',user_id:'{{$ticket->user_id}}',reply:msg}, function(data){
                    generate_message(msg, 'self');
                })
            });
            function generate_message(msg, type) {
                var str = `
         <div class="userSend">
            <div class="sendMassage">
              <p> ${msg} </p>
              <div class=" time">
                <span>  {{ \Carbon\Carbon::createFromFormat('Y-m-d H:i:s',now())->format('F d,Y')}} </span>
              </div>
            </div>
          </div>
        `;
                $(".chatBody").append(str);
                if (type == 'self') {
                    $("#chat-input").val('');
                }
                $(".chatBody").stop().animate({
                    scrollTop: $(".chatBody")[0].scrollHeight
                }, 1000);
            }
        })
    </script>
    <!--  -->
    <script>
        // category Users
        $(".UsersControl").on('click', function () {
            $(".Users").removeClass("hideUsers").addClass("showUsers");
        });
        $(".closeUsers").on('click', function () {
            $(".Users").removeClass("showUsers").addClass("hideUsers");
        });
    </script>