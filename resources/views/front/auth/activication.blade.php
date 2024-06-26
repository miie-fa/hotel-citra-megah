@extends('front.auth.layouts.app')

@section('content')
    <section>
        <div class="relative flex min-h-screen flex-col justify-center overflow-hiddenpy-12">
            <div class="relative bg-white px-6 pt-10 pb-9 shadow-xl mx-auto w-full max-w-lg rounded-2xl">
              <div class="mx-auto flex w-full max-w-md flex-col space-y-16">
                <div class="flex flex-col items-center justify-center text-center space-y-2">
                  <div class="font-semibold text-3xl">
                    <p>Phone Verification</p>
                  </div>
                  <div class="flex flex-row text-sm font-medium text-gray-400">
                    <p>We have sent a code to your WhatsApp {{ '********' . Str::substr($userPhone, -4) }}</p>
                  </div>
                </div>

                <div>
                  <form action="{{route('activication.process')}}" method="post">
                    @csrf
                    @method('POST')
                    <div class="flex flex-col space-y-16">
                      <div class="flex flex-row items-center justify-between mx-auto w-full max-w-xs">
                        <div class="w-full h-16 ">
                          <input class="w-full h-full flex flex-col items-center justify-center text-center px-5 outline-4 rounded-xl border border-gray-400 text-lg bg-white focus:bg-gray-50 focus:ring-1 ring-blue-700" type="number" name="token" id="token">
                        </div>
                      </div>

                      <div class="flex flex-col space-y-5">
                        <div>
                          <button class="flex flex-row items-center justify-center text-center w-full border rounded-xl outline-none py-5 bg-blue-700 border-none text-white text-sm shadow-sm">
                            Verify Account
                          </button>
                        </div>

                        <div class="flex flex-row items-center justify-center text-center text-sm font-medium space-x-1 text-gray-500">
                          {{-- <p>Didn't recieve code?</p> <a class="flex flex-row items-center text-blue-600" href="http://" target="_blank" rel="noopener noreferrer">Resend</a> --}}
                        </div>
                      </div>
                    </div>
                  </form>
                </div>
              </div>
            </div>
          </div>


    </section>
@endsection

@push('js-custom')
    <script>
        const showPasswordButton = document.getElementById('showPasswordButton');
        const passwordInput = document.getElementById('password');

        showPasswordButton.addEventListener('click', (event) => {
            event.preventDefault(); // Prevent the default button action
            if (passwordInput.type === 'password') {
                passwordInput.type = 'text';
            } else {
                passwordInput.type = 'password';
            }
        });

        var otp_inputs = document.querySelectorAll(".otp__digit")
        var mykey = "0123456789".split("")
        otp_inputs.forEach((_)=>{
        _.addEventListener("keyup", handle_next_input)
        })
        function handle_next_input(event){
        let current = event.target
        let index = parseInt(current.classList[1].split("__")[2])
        current.value = event.key

        if(event.keyCode == 8 && index > 1){
            current.previousElementSibling.focus()
        }
        if(index < 6 && mykey.indexOf(""+event.key+"") != -1){
            var next = current.nextElementSibling;
            next.focus()
        }
        var _finalKey = ""
        for(let {value} of otp_inputs){
            _finalKey += value
        }
        if(_finalKey.length == 6){
            document.querySelector("#_otp").classList.replace("_notok", "_ok")
            document.querySelector("#_otp").innerText = _finalKey
        }else{
            document.querySelector("#_otp").classList.replace("_ok", "_notok")
            document.querySelector("#_otp").innerText = _finalKey
        }
        }
    </script>
@endpush
