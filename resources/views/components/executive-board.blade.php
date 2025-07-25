<div>
    <h2 class="section-title" id="management-title">คณะผู้บริหาร</h2>
    <div class="management-grid" id="managementGrid">
        @foreach($staffs as $staff)
            <div class="management-card position-{{ $loop->iteration }}">
                <div class="management-avatar">
                    <img src="{{ $staff->img ? asset('storage/'.$staff->img) : 'image/avatar.png' }}" alt="{{ $staff->full_name }}">
                </div>
                <div class="management-name">
                    {{ \App\Models\Staff::getRoles()[$staff->role] ?? $staff->role }}
                </div>
                <div class="management-position">
                    ชื่อ {{ $staff->full_name }}<br>
                    เบอร์โทร {{ $staff->phone }}
                </div>
            </div>
        @endforeach
    </div>
</div>
