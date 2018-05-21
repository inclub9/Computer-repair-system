@if(\Illuminate\Support\Facades\Auth::guard('web')->check())
    <p class="text-success">
        You are Logged In as a
        <strog>USER</strog>
    </p>
@else
    <p class="text-danger">
        You are Logged Out as a
        <strog>USER</strog>
    </p>
@endif
@if(\Illuminate\Support\Facades\Auth::guard('admin')->check())
    <p class="text-success">
        You are Logged In as a
        <strog>admin</strog>
    </p>
@else
    <p class="text-danger">
        You are Logged Out as a
        <strog>admin</strog>
    </p>
@endif