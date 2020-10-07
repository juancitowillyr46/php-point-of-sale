import { AfterViewInit, Component, OnInit } from '@angular/core';
import { FormBuilder, FormGroup, Validators } from '@angular/forms';
import { Router } from '@angular/router';
import { SignInDto } from 'src/app/domain/security/model/signin.dto';
import { SignInUseCase } from '../../domain/security/usecase/signin.usecase';
import { MeUseCase } from '../../domain/security/usecase/me.usecase';

@Component({
  selector: 'app-login',
  templateUrl: './login.component.html',
  styleUrls: ['./login.component.css']
})
export class LoginComponent implements OnInit, AfterViewInit {

  public submit: any;
  public formGroup: FormGroup = null;

  public signIn: SignInDto = {
    username: '',
    password: ''
  };

  constructor(
    private signInUseCase: SignInUseCase,
    private meUseCase: MeUseCase,
    private formBuilder: FormBuilder,
    private router: Router
  ) { 
    
  }

  ngOnInit(): void {
    const that = this;
    that.formGroup = that.formBuilder.group({
      username: ['', [Validators.required, Validators.email]],
      password: ['', [Validators.required, Validators.minLength(8)]],
    });
    
  }

  ngAfterViewInit(): void {
    const that = this;
  }

  onSubmit() {

    const that = this;

    that.submit = true;

    that.signInUseCase.execute({
      'username': that.formGroup.value.username,
      'password': that.formGroup.value.password
    }).subscribe(res => {
      that.submit = false;
      if(res.token != ''){
        localStorage.setItem('accessToken', res.token);
        that.formGroup.reset();
        that.router.navigateByUrl('modules/users/maintainer');
      }
    }, (error) => {
      that.formGroup.reset();
      that.submit = false;
    });
  }

}
