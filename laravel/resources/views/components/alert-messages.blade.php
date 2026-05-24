{{-- 1. ALERT SUKSES --}}
@if(session('success'))
    <div class="mb-5 rounded-xl border border-green-200 bg-green-50 px-4 py-3 text-sm text-green-700 animate-fade-in">
        {{ session('success') }}
    </div>
@endif

{{-- 2. ALERT GAGAL / ERROR DARI SESSION --}}
@if(session('error'))
    <div class="mb-5 rounded-xl border border-red-200 bg-red-50 px-4 py-3 text-sm text-red-700 animate-fade-in">
        {{ session('error') }}
    </div>
@endif

{{-- 3. ALERT VALIDATION ERRORS (DARI INPUT FORM) --}}
@if($errors->any())
    <div class="mb-5 rounded-xl border border-red-200 bg-red-50 px-4 py-3 text-sm text-red-700 animate-fade-in">
        <ul class="list-disc pl-5 space-y-1">
            @foreach($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif