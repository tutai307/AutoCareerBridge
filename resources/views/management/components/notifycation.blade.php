<li onclick="changeStatus({{ $notification->id }})">
    <a href="{{ url($notification->link) }}">
        <div class="timeline-panel {{ $notification->is_seen == SEEN ? 'read' : '' }}">
            <div class="media me-2">
                @if ($notification->type === TYPE_JOB)
                    <i class="fa-solid fa-briefcase"></i>
                @elseif($notification->type === TYPE_COMPANY)
                    <i class="fa-solid fa-building"></i>
                @elseif($notification->type === TYPE_UNIVERSITY)
                    <i class="fa-solid fa-building-columns"></i>
                @elseif($notification->type === TYPE_WORKSHOPS)
                    <i class="fa-solid fa-chalkboard-teacher"></i>
                @elseif($notification->type === TYPE_COLLABORATION)
                    <i class="fas fa-handshake"></i>
                @endif
            </div>
            <div class="media-body">
                <h6 class="mb-1">{{ $notification->title }}</h6>
                <small
                    class="d-block">{{ date('d/m/Y H:i', strtotime($notification->created_at)) }}
                </small>
            </div>
        </div>
        <div class="timeline-border"> </div>
    </a>
</li>
