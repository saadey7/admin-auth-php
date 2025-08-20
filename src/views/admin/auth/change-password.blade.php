 <!doctype html>
 <html class="no-js " lang="en">
 <head>
     <meta charset="UTF-8" />
     <meta name="viewport" content="width=device-width, initial-scale=1.0" />
     <script src="https://unpkg.com/@tailwindcss/browser@4"></script>
 </head>
 <body>
     <div
         class="flex min-h-screen items-center justify-center bg-gradient-to-br from-blue-200 to-purple-400 relative pb-32">
         <div class="w-full rounded-lg bg-slate-900 p-10 text-sm text-indigo-300 sm:w-96 max-w-96 mt-18">
             <h1 class="mb-4 text-center text-3xl font-semibold text-white">Reset Password</h1>
             <p class="mb-6 text-center text-sm">Change your password</p>
             <form method="POST" action="{{ route('admin.pass.code') }}">
                @csrf
                 <div class="mb-5 flex gap-3 rounded-full bg-[#333A5c] px-6 py-3">
                    <svg viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg" class="w-4">
                         <path
                             d="M12 14.5V16.5M7 10.0288C7.47142 10 8.05259 10 8.8 10H15.2C15.9474 10 16.5286 10 17 10.0288M7 10.0288C6.41168 10.0647 5.99429 10.1455 5.63803 10.327C5.07354 10.6146 4.6146 11.0735 4.32698 11.638C4 12.2798 4 13.1198 4 14.8V16.2C4 17.8802 4 18.7202 4.32698 19.362C4.6146 19.9265 5.07354 20.3854 5.63803 20.673C6.27976 21 7.11984 21 8.8 21H15.2C16.8802 21 17.7202 21 18.362 20.673C18.9265 20.3854 19.3854 19.9265 19.673 19.362C20 18.7202 20 17.8802 20 16.2V14.8C20 13.1198 20 12.2798 19.673 11.638C19.3854 11.0735 18.9265 10.6146 18.362 10.327C18.0057 10.1455 17.5883 10.0647 17 10.0288M7 10.0288V8C7 5.23858 9.23858 3 12 3C14.7614 3 17 5.23858 17 8V10.0288"
                             stroke="#64748b" stroke-width="3" stroke-linecap="round" stroke-linejoin="round"></path>
                     </svg>
                     <input type="password" placeholder="New Paswword" name="password" class="border-none outline-none" />
                 </div>
                 <div class="mb-5 flex gap-3 rounded-full bg-[#333A5c] px-6 py-3">
                     <svg viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg" class="w-4">
                         <path
                             d="M12 14.5V16.5M7 10.0288C7.47142 10 8.05259 10 8.8 10H15.2C15.9474 10 16.5286 10 17 10.0288M7 10.0288C6.41168 10.0647 5.99429 10.1455 5.63803 10.327C5.07354 10.6146 4.6146 11.0735 4.32698 11.638C4 12.2798 4 13.1198 4 14.8V16.2C4 17.8802 4 18.7202 4.32698 19.362C4.6146 19.9265 5.07354 20.3854 5.63803 20.673C6.27976 21 7.11984 21 8.8 21H15.2C16.8802 21 17.7202 21 18.362 20.673C18.9265 20.3854 19.3854 19.9265 19.673 19.362C20 18.7202 20 17.8802 20 16.2V14.8C20 13.1198 20 12.2798 19.673 11.638C19.3854 11.0735 18.9265 10.6146 18.362 10.327C18.0057 10.1455 17.5883 10.0647 17 10.0288M7 10.0288V8C7 5.23858 9.23858 3 12 3C14.7614 3 17 5.23858 17 8V10.0288"
                             stroke="#64748b" stroke-width="3" stroke-linecap="round" stroke-linejoin="round"></path>
                     </svg>
                     <input type="password" name="password_confirmation" placeholder="Confirm Password" class="border-none outline-none" />
                 </div>
                 <button type="submit"
                     class="w-full rounded-full bg-gradient-to-r from-indigo-400 to-indigo-900 py-3 font-medium tracking-wide text-white cursor-pointer">Reset Password</button>
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
 </body>
 </html>