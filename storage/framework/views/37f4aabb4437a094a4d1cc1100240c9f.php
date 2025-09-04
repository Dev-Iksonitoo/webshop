<?php $__env->startSection('content'); ?>
<div class="container mt-5">
    <div class="row justify-content-center">
        <div class="col-md-6">
            <div class="card auth-card">
                <div class="card-header">
                    <h3 class="text-center">შესვლა</h3>
                </div>
                <div class="card-body">
                    <form method="POST" action="<?php echo e(route('login')); ?>">
                        <?php echo csrf_field(); ?>

                        <div class="form-group mb-3">
                            <label for="username">მომხმარებლის სახელი</label>
                            <input id="username" type="text" class="form-control <?php $__errorArgs = ['username'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>" name="username" value="<?php echo e(old('username')); ?>" required autocomplete="username" autofocus>
                            <?php $__errorArgs = ['username'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                                <span class="invalid-feedback" role="alert">
                                    <strong><?php echo e($message); ?></strong>
                                </span>
                            <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                        </div>

                        <div class="form-group mb-3">
                            <label for="password">პაროლი</label>
                            <input id="password" type="password" class="form-control <?php $__errorArgs = ['password'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>" name="password" required autocomplete="current-password">
                            <?php $__errorArgs = ['password'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                                <span class="invalid-feedback" role="alert">
                                    <strong><?php echo e($message); ?></strong>
                                </span>
                            <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                        </div>

                        <div class="form-group mb-3">
                            <div class="form-check">
                                <input class="form-check-input" type="checkbox" name="remember" id="remember" <?php echo e(old('remember') ? 'checked' : ''); ?>>
                                <label class="form-check-label" for="remember">
                                    დამიმახსოვრე
                                </label>
                            </div>
                        </div>

                        <div class="form-group mb-0">
                            <button type="submit" class="btn btn-primary w-100">
                                შესვლა
                            </button>
                        </div>
                    </form>
                </div>
                <div class="card-footer text-center">
                    <p>არ გაქვთ ანგარიში? <a href="<?php echo e(route('register')); ?>">რეგისტრაცია</a></p>
                </div>
            </div>
        </div>
    </div>
</div>

<style>
    .auth-card {
        background-color: rgba(0, 0, 0, 0.7);
        color: white;
        border: 2px solid #ff0000;
        border-radius: 15px;
    }
    
    .auth-card .card-header {
        background-color: rgba(0, 0, 0, 0.5);
        border-bottom: 1px solid #ff0000;
        padding: 15px;
    }
    
    .auth-card .card-footer {
        background-color: rgba(0, 0, 0, 0.5);
        border-top: 1px solid #ff0000;
    }
    
    .auth-card input {
        background-color: rgba(0, 0, 0, 0.5);
        color: white;
        border: 1px solid #444;
    }
    
    .auth-card input:focus {
        background-color: rgba(0, 0, 0, 0.7);
        color: white;
        border-color: #ff0000;
        box-shadow: 0 0 0 0.2rem rgba(255, 0, 0, 0.25);
    }
    
    .auth-card .btn-primary {
        background-color: #ff0000;
        border-color: #ff0000;
    }
    
    .auth-card .btn-primary:hover {
        background-color: #cc0000;
        border-color: #cc0000;
    }
    
    .auth-card a {
        color: #ff0000;
    }
    
    .auth-card a:hover {
        color: #cc0000;
    }
</style>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\Users\ADMIN\Desktop\ტრეა\weed-store\resources\views/auth/login.blade.php ENDPATH**/ ?>