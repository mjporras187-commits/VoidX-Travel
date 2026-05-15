<x-guest-layout>
    <link href="https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css" rel="stylesheet" />
   
    <style>
        /* 1. Global Reset & Background */
        .elite-wrapper {
            position: fixed;
            top: 0; left: 0;
            width: 100%; height: 100%;
            display: flex; justify-content: center; align-items: center;
            background: #0f0f0f; /* Dark Premium Theme */
            font-family: 'Poppins', sans-serif;
            z-index: 1000;
        }

        /* 2. Floating Form Box */
        .form-box {
            position: relative;
            width: 500px;
            height: 600px; /* Adjusted height */
            background: rgba(255, 255, 255, 0.05);
            backdrop-filter: blur(15px);
            border: 2px solid rgba(255, 255, 255, 0.1);
            border-radius: 20px;
            box-shadow: 0px 0px 30px rgba(212, 175, 55, 0.2);
            overflow: hidden;
        }

        /* 3. Sliding Logic Containers */
        .login-container, .register-container {
            position: absolute;
            width: 100%;
            padding: 0 40px;
            transition: .6s cubic-bezier(0.68, -0.55, 0.265, 1.55);
        }

        .login-container { left: 4px; top: 100px; }
        .register-container { right: -520px; top: 100px; opacity: 0; }

        /* 4. Logo & Headers */
        .nav-logo { text-align: center; padding: 30px 0 10px 0; }
        .nav-logo p {
            font-size: 28px; font-weight: 800; letter-spacing: 2px;
            background: linear-gradient(45deg, #ffffff, #d4af37, #ffffff);
            background-size: 200% auto;
            -webkit-background-clip: text; -webkit-text-fill-color: transparent;
            animation: shine 3s linear infinite;
        }
        @keyframes shine { to { background-position: 200% center; } }
        
        header { font-size: 30px; color: #fff; font-weight: 600; text-align: center; margin-bottom: 20px; }

        /* 5. Input Styles */
        .input-box { position: relative; margin: 15px 0; }
        .input-field {
            width: 100%; height: 50px; background: rgba(255, 255, 255, 0.1);
            color: #fff; border: 1px solid rgba(255, 255, 255, 0.2);
            border-radius: 10px; padding: 0 45px; outline: none; transition: .3s;
        }
        .input-field:focus { border-color: #d4af37; background: rgba(255, 255, 255, 0.15); }
        .input-box i { position: absolute; top: 15px; left: 15px; color: #d4af37; font-size: 20px; }

        /* 6. Buttons */
        .submit {
            width: 100%; height: 50px; background: #d4af37; border: none;
            border-radius: 10px; color: #000; font-weight: 700;
            cursor: pointer; transition: .3s; margin-top: 10px;
        }
        .submit:hover { background: #fff; box-shadow: 0px 0px 15px #d4af37; transform: translateY(-2px); }

        .top-switch { color: #ccc; font-size: 14px; text-align: center; margin-top: 20px; }
        .top-switch a { color: #d4af37; font-weight: 600; text-decoration: none; }

        .error-msg { color: #ff4d4d; font-size: 11px; margin-top: 2px; display: block; font-weight: 500; }
    </style>

    <div class="elite-wrapper">
        <div class="form-box">
            <div class="nav-logo">
                <p><i class='bx bxs-plane-take-off'></i> VOIDX</p>
                <span style="color: #d4af37; font-size: 10px; letter-spacing: 2px;">ELITE SELECTION</span>
            </div>

            <form action="{{ route('login') }}" method="POST" class="login-container" id="login">
                @csrf
                <header>Welcome Back</header>
                
                <div class="input-box">
                    <input type="email" name="email" class="input-field" placeholder="Email Address" value="{{ old('email') }}" required autofocus autocomplete="username">
                    <i class="bx bx-user"></i>
                    @error('email') <span class="error-msg">{{ $message }}</span> @enderror
                </div>

                <div class="input-box">
                    <input type="password" name="password" class="input-field" placeholder="Password" required autocomplete="current-password">
                    <i class="bx bx-lock-alt"></i>
                    @error('password') <span class="error-msg">{{ $message }}</span> @enderror
                </div>

                <div style="margin-bottom: 15px; display: flex; align-items: center; gap: 8px;">
                    <input id="remember_me" type="checkbox" name="remember" style="accent-color: #d4af37;">
                    <label for="remember_me" style="color: #ccc; font-size: 12px;">Keep me logged in</label>
                </div>

                <input type="submit" class="submit" value="Unlock Adventure">

                <div class="top-switch">
                    <span>Don't have an account? <a href="javascript:void(0)" onclick="registerSlide()">Sign Up</a></span>
                </div>
            </form>

            <form action="{{ route('register') }}" method="POST" class="register-container" id="register">
                @csrf
                <header>Join the Journey</header>

                <div class="input-box">
                    <input type="text" name="name" class="input-field" placeholder="Full Name" value="{{ old('name') }}" required autocomplete="name">
                    <i class="bx bx-user-circle"></i>
                    @error('name') <span class="error-msg">{{ $message }}</span> @enderror
                </div>

                <div class="input-box">
                    <input type="email" name="email" class="input-field" placeholder="Email Address" value="{{ old('email') }}" required autocomplete="username">
                    <i class="bx bx-envelope"></i>
                    @error('email') <span class="error-msg">{{ $message }}</span> @enderror
                </div>

                <div class="input-box">
                    <input type="password" name="password" class="input-field" placeholder="Password" required autocomplete="new-password">
                    <i class="bx bx-lock-alt"></i>
                    @error('password') <span class="error-msg">{{ $message }}</span> @enderror
                </div>

                <div class="input-box">
                    <input type="password" name="password_confirmation" class="input-field" placeholder="Confirm Password" required autocomplete="new-password">
                    <i class="bx bx-check-shield"></i>
                    @error('password_confirmation') <span class="error-msg">{{ $message }}</span> @enderror
                </div>

                <input type="submit" class="submit" value="Start Traveling">

                <div class="top-switch">
                    <span>Already a member? <a href="javascript:void(0)" onclick="loginSlide()">Login now</a></span>
                </div>
            </form>
        </div>
    </div>

    <script>
        var x = document.getElementById("login");
        var y = document.getElementById("register");

        function registerSlide() {
            x.style.left = "-510px";
            y.style.right = "5px";
            x.style.opacity = "0";
            y.style.opacity = "1";
        }

        function loginSlide() {
            x.style.left = "4px";
            y.style.right = "-520px";
            x.style.opacity = "1";
            y.style.opacity = "0";
        }

        // AUTO-SLIDE LOGIC kapag galing sa Welcome Page Sign Up o kapag may errors
        window.onload = function() {
            const urlParams = new URLSearchParams(window.location.search);
            // Slide to register if action is register OR if there are validation errors on registration fields
            if (urlParams.get('action') === 'register' || {{ $errors->has('name') || $errors->has('password_confirmation') ? 'true' : 'false' }}) {
                registerSlide();
            }
        }
    </script>
</x-guest-layout>