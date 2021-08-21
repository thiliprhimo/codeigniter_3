    <link rel="stylesheet" href="<?php echo base_url('assets/css/auth/register.css')?>">
<body>
    <div class="container">
        <div class="row">
            <div class="col"></div>
            <div class="col align-self-center">
                <h2 class="register-head">Register</h2>

                <span class="error" style="display:none;"></span>

                <form action="<?php echo base_url('auth/register/store')?>" class="register_form" id="register_form">
                    <label for="name">Name : </label>
                    <input type="text" name="name" id="name" class="form-control lock" autofocus>
                    <label for="name">Email : </label>
                    <input type="email" name="email" id="email" class="form-control lock">
                    <label for="name">Password : </label>
                    <input type="password" name="password" id="password" class="form-control lock">
                    <br />
                    <button type="submit lock" class="btn btn-success">Submit</button>
                </form>
            </div>
            <div class="col"></div>
        </div>
    </div>
</body>
    <script src="<?php echo base_url('assets/js/auth/register.js')?>"></script>