    <link rel="stylesheet" href="<?php echo base_url('assets/css/auth/login.css');?>">
</head>
<body>
    <div class="container">
        <div class="row align-items-center">
            <div class="col-md-4 align-self-start"></div>
            <div class="col-md-4 align-self-center">
                <p class='success login-head'>
                    <?php 
                    if($this->session->flashdata('register_success')){
                        echo $this->session->flashdata('register_success');
                    }
                    if($this->session->flashdata('confirmation_success')){
                        echo $this->session->flashdata('confirmation_success');
                    }
                    ?>
                </p>

                <h2>Login</h2>

                <span class='error' style="display:none;"></span> 
                                
                <form id="login_form" class="login_form" action="<?php echo base_url('auth/login/verify')?>">
                    <label for="username">Username : </label>
                    <input type="text" name="username" class="username form-control" id="username" autofocus></input>

                    <label for="password">Password : </label>
                    <input type="password" name="password" id="password" class="password form-control">
                    <br/>
                    <input type="submit" value="Submit" class="btn btn-success">
                </form>
            </div>
            <div class="col-md-4 align-self-end"></div>
        </div>
    </div>
</body>
    <script src="<?php echo base_url('assets/js/auth/login.js')?>"></script>