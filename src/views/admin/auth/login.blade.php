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
             <h1 class="mb-4 text-center text-3xl font-semibold text-white">Login</h1>
             <p class="mb-6 text-center text-sm">Welcome Back!</p>
             <form method="POST" action="{{ route('admin.storelogin') }}">
                @csrf
                 <div class="mb-5 flex gap-3 rounded-full bg-[#333A5c] px-6 py-3">
                     <svg viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg" class="w-4">
                         <path
                             d="M3 8L8.44992 11.6333C9.73295 12.4886 10.3745 12.9163 11.0678 13.0825C11.6806 13.2293 12.3194 13.2293 12.9322 13.0825C13.6255 12.9163 14.2671 12.4886 15.5501 11.6333L21 8M6.2 19H17.8C18.9201 19 19.4802 19 19.908 18.782C20.2843 18.5903 20.5903 18.2843 20.782 17.908C21 17.4802 21 16.9201 21 15.8V8.2C21 7.0799 21 6.51984 20.782 6.09202C20.5903 5.71569 20.2843 5.40973 19.908 5.21799C19.4802 5 18.9201 5 17.8 5H6.2C5.0799 5 4.51984 5 4.09202 5.21799C3.71569 5.40973 3.40973 5.71569 3.21799 6.09202C3 6.51984 3 7.07989 3 8.2V15.8C3 16.9201 3 17.4802 3.21799 17.908C3.40973 18.2843 3.71569 18.5903 4.09202 18.782C4.51984 19 5.07989 19 6.2 19Z"
                             stroke="#64748b" stroke-width="3" stroke-linecap="round" stroke-linejoin="round"></path>
                     </svg>
                     <input type="email" placeholder="Email" name="email" class="border-none outline-none" />
                 </div>
                 <div class="mb-5 flex gap-3 rounded-full bg-[#333A5c] px-6 py-3">
                     <svg viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg" class="w-4">
                         <path
                             d="M12 14.5V16.5M7 10.0288C7.47142 10 8.05259 10 8.8 10H15.2C15.9474 10 16.5286 10 17 10.0288M7 10.0288C6.41168 10.0647 5.99429 10.1455 5.63803 10.327C5.07354 10.6146 4.6146 11.0735 4.32698 11.638C4 12.2798 4 13.1198 4 14.8V16.2C4 17.8802 4 18.7202 4.32698 19.362C4.6146 19.9265 5.07354 20.3854 5.63803 20.673C6.27976 21 7.11984 21 8.8 21H15.2C16.8802 21 17.7202 21 18.362 20.673C18.9265 20.3854 19.3854 19.9265 19.673 19.362C20 18.7202 20 17.8802 20 16.2V14.8C20 13.1198 20 12.2798 19.673 11.638C19.3854 11.0735 18.9265 10.6146 18.362 10.327C18.0057 10.1455 17.5883 10.0647 17 10.0288M7 10.0288V8C7 5.23858 9.23858 3 12 3C14.7614 3 17 5.23858 17 8V10.0288"
                             stroke="#64748b" stroke-width="3" stroke-linecap="round" stroke-linejoin="round"></path>
                     </svg>
                     <input type="password" name="password" placeholder="Password" class="border-none outline-none" />
                 </div>
                 <p class="mb-6 mr-2 text-sm flex justify-end cursor-pointer"><a
                         href="{{route('admin.reset-form')}}" target="_blank" class="text-blue-400">Forgot
                         Password?</a></p>
                 <button type="submit"
                     class="w-full rounded-full bg-gradient-to-r from-indigo-400 to-indigo-900 py-3 font-medium tracking-wide text-white cursor-pointer">Login</button>
             </form>
             <p class="mt-4 mb-7 text-center text-sm text-slate-400">Don't Have an account? <a
                     href="{{route('admin.showregister')}}" target="_blank"
                     class="hover:underline text-blue-400">Sign Up</a></p>
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