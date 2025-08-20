<!doctype html>
<html class="no-js " lang="en">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <script src="https://unpkg.com/@tailwindcss/browser@4"></script>
</head>

<body>
    <div class="relative flex min-h-screen items-center justify-center bg-gradient-to-br from-blue-200 to-purple-400">
        <div class="w-full max-w-96 rounded-lg bg-slate-900 p-10 text-sm text-indigo-300 sm:w-96 mt-18">
            <h1 class="mb-4 text-center text-3xl font-semibold text-white">Verification Code</h1>
            <p class="mb-6 text-center text-sm">Enter the 4-digit code we've sent to your mail</p>
            <form method="POST" action="{{route('admin.confirm-code')}}">
                @csrf
                <input type="hidden" name="email" value="{{$email}}">
                <div class="flex mb-6 gap-4 justify-center">
                    <input type="text" placeholder="*" name="otp[]"
                        class="otp-input outline-none w-12 h-12 rounded-sm text-center bg-[#333A5c] font-base text-xl border-1 border-b-blue-300"
                        maxlength="1" required />
                    <input type="text" placeholder="*" name="otp[]"
                        class="otp-input outline-none w-12 h-12 rounded-sm text-center bg-[#333A5c] font-base text-xl border-1 border-b-blue-300"
                        maxlength="1" required />
                    <input type="text" placeholder="*" name="otp[]"
                        class="otp-input outline-none w-12 h-12 rounded-sm text-center bg-[#333A5c] font-base text-xl border-1 border-b-blue-300"
                        maxlength="1" required />
                    <input type="text" placeholder="*" name="otp[]"
                        class="otp-input outline-none w-12 h-12 rounded-sm text-center bg-[#333A5c] font-base text-xl border-1 border-b-blue-300"
                        maxlength="1" required />
                </div>

                <button type="submit"
                    class="w-full cursor-pointer rounded-full bg-gradient-to-r from-indigo-400 to-indigo-900 py-3 font-medium tracking-wide text-white">Verify</button>
            </form>
            <p class="mt-5 text-center text-sm">
                <a href="{{route('admin.showlogin')}}"
                    class="flex items-center justify-center gap-2 text-slate-400 hover:underline" target="_blank">
                    <svg viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg" class="h-5 w-5">
                        <path d="M4 12H20M4 12L8 8M4 12L8 16" stroke="#94a3b8" stroke-width="2" stroke-linecap="round"
                            stroke-linejoin="round"></path>
                    </svg>
                    <span>Back to log in</span>
                </a>
            </p>
            <div class="text-center mb-3">
                <script type="text/javascript">window.setTimeout("document.getElementById('popmessage').style.display='none';", 6000); </script>
                @if(session()->has('error'))
                    <div id="popmessage" class="text-danger form-control-feedback">
                       @php $errors =  session()->get('error');  @endphp
                        @foreach ($errors->all() as $error)
                            {{ $error }}<br/>
                        @endforeach
                    </div>
                @endif
                @if(session()->has('success'))
                    <div id="popmessage" class="text-success form-control-feedback">
                        {{ session()->get('success') }}
                    </div>
                @endif
            </div>
        </div>
        <!-- <p class="absolute bottom-10 right-20 font-semibold text-slate-700">Inspired from <a
                href="https://youtu.be/7BTsepZ9xp8?si=FKKKC2QruJa_EYnc" target="_blank"
                class="text-indigo-800 underline">
                GreatStack
            </a></p> -->
    </div>
    <script>
    const otpInputs = document.querySelectorAll('.otp-input');

    otpInputs.forEach((input, index) => {
        input.addEventListener('input', (e) => {
            if (e.target.value.length === 1) {
                if (index < otpInputs.length - 1) {
                    otpInputs[index + 1].focus();
                }
            }
        });

        input.addEventListener('keydown', (e) => {
            if (e.key === 'Backspace' && !input.value) {
                if (index > 0) {
                    otpInputs[index - 1].focus();
                }
            }
        });
    });
    </script>
</body>

</html>