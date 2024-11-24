@foreach($conversation->messages as $message)
    @if($message->user_id == Auth::user()->id)
        <div class="wrapper-chat-msg">
            <div class="chat-msg">
                <p>  {{ $message->message }}</p>
            </div>
            <div class="wrap-time">  {{ date('h:i a d-m-Y', strtotime($message->created_at)) }}</div>

            @foreach ((explode(",",$message->files)) as $key => $file)
                @php $file_detail = \App\Models\Upload::where('id', $file)->first(); @endphp
                @if($file_detail != null)
                    <a href="{{ uploaded_asset($file) }}" download="" class="badge badge-lg badge-inline badge-light mb-1">
                        <i class="las la-download text-muted">{{ $file_detail->file_original_name.'.'.$file_detail->extension }}</i>
                    </a>
                    <br>
                @endif
            @endforeach
        </div>
    @else
        <div class="wrapper-chat-msg wrapper-left">
            <div class="img-chat"> <img  alt="{{request()->path()}}" src="{{ static_asset('v2_assets/img/trf-avatar.png') }}"  > </div>
            <div class="chat-msg chat-left-side">
                <p>  {{ $message->message }}</p>
            </div>
            <div class="wrap-time">  {{ date('h:i a d-m-Y', strtotime($message->created_at)) }}</div>
            @foreach ((explode(",",$message->files)) as $key => $file)
                @php $file_detail = \App\Models\Upload::where('id', $file)->first(); @endphp
                @if($file_detail != null)
                    <a href="{{ uploaded_asset($file) }}" download="" class="badge badge-lg badge-inline badge-light mb-1">
                        <i class="las la-download text-muted">{{ $file_detail->file_original_name.'.'.$file_detail->extension }}</i>
                    </a>
                    <br>
                @endif
            @endforeach
        </div>
    @endif
@endforeach

