            <div class="modal fade" id="loginModal">
              <div class="modal-dialog modal-lg">
                  <div class="modal-content">
                     <div class="modal-header">
                        <h4 class="modal-title">Login with</h4>
                        <span class="close" data-dismiss="modal" aria-hidden="true" style="cursor: pointer;">×</span>

                    </div>
                    <div class="modal-body">
                        <div class="box">
                             <div class="content">
                                <div class="error"></div>
                                <div class="form loginBox">
                                    <form action="/sublime/action/login.php" method="post" id="formDN" accept-charset="UTF-8">
                                    <div class="form-group">
                                    <input id="email" class="form-control" type="text" placeholder="Email" name="email">
                                    <p class="formError_DN_user"></p>
                                    </div>
                                    <div class="form-group">
                                    <input id="password" class="form-control" type="password" placeholder="Password" name="password">
                                    <p class="formError_DN_pass"></p>
                                    </div>
                                    <div class="form-group">
                                    <input class="btn btn-primary btn-block" type="submit" value="Login" id="submit">
                                    <!--onclick="loginAjax()"-->
                                    </div>
                                    </form>
                                </div>
                             </div>
                        </div>
                        <div class="box">
                            <div class="content registerBox" style="display:none;">
                             <div class="form">
                                <!--html="{:multipart=>true}" -->
                                <form action="/sublime/action/register.php" method="post" id="formDK" data-remote="true" accept-charset="UTF-8">
                                  <div class="form-group">
                                    <input id="username" class="form-control" type="text" placeholder="User Name" name="username">
                                    <p class="formError_DK_user"></p>
                                </div>
                                <div class="form-group">
                                    <input id="email" class="form-control" type="text" placeholder="Email" name="email">
                                    <p class="formError_DK_mail"></p>
                                </div>
                                <div class="form-group">
                                <input id="password" class="form-control" type="password" placeholder="Password" name="password">
                                <p class="formError_DK_pass"></p>
                                </div>
                                <div class="form-group">
                                <input id="password_confirmation" class="form-control" type="password" placeholder="Repeat Password" name="password_confirmation">
                                <p class="formError_DK_repass"></p>
                                </div>
                                <input class="btn btn-success btn-block" type="submit" value="Create account" name="commit" id="submit">
                                </form>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <div class="forgot login-footer">
                            <span>Looking to
                                 <a href="javascript: showRegisterForm();">create an account</a>
                            ?</span>
                        </div>
                        <div class="forgot register-footer" style="display:none">
                             <span>Already have an account?</span>
                             <a href="javascript: showLoginForm();">Login</a>
                        </div>
                    </div>
                  </div>
              </div>
          </div>

