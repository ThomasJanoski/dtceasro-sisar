import { Component } from '@angular/core';
import { FormBuilder, ReactiveFormsModule, Validators } from '@angular/forms';
import { Router } from '@angular/router';
import { AuthService } from '../services/auth.service';

@Component({
  selector: 'login-page',
  standalone: true,
  imports: [ReactiveFormsModule],
  template: `
    <div class="page login-page">
      <div class="card login-card">
        <h1>Login</h1>
        <form [formGroup]="form" (ngSubmit)="submit()">
          <label for="username">Usuário</label>
          <input id="username" formControlName="username" autocomplete="username" />

          <label for="password">Senha</label>
          <input id="password" type="password" formControlName="password" autocomplete="current-password" />

          <button type="submit" [disabled]="form.invalid">Entrar</button>
        </form>
        <div class="error" *ngIf="error">{{ error }}</div>
      </div>
    </div>
  `,
  styles: [
    `
      .page { display: flex; justify-content: center; align-items: center; min-height: 100vh; background: #f4f6fb; }
      .login-card { width: min(420px, 90vw); border-radius: 16px; background: white; padding: 2rem; box-shadow: 0 18px 80px rgba(20, 30, 50, 0.08); }
      h1 { margin: 0 0 1rem; font-size: 1.75rem; }
      label { display: block; margin: 1rem 0 0.5rem; font-weight: 600; }
      input { width: 100%; padding: 0.85rem 1rem; border-radius: 10px; border: 1px solid #d7dee8; font-size: 1rem; }
      button { margin-top: 1.5rem; width: 100%; padding: 0.95rem; background: #0066cc; color: white; border: none; border-radius: 10px; font-weight: 700; cursor: pointer; }
      button:disabled { opacity: 0.6; cursor: not-allowed; }
      .error { margin-top: 1rem; color: #b00020; }
    `
  ]
})
export class LoginComponent {
  form = this.fb.group({
    username: ['', [Validators.required]],
    password: ['', [Validators.required]],
  });

  error = '';

  constructor(private fb: FormBuilder, private auth: AuthService, private router: Router) {}

  submit(): void {
    if (this.form.invalid) return;

    this.error = '';
    this.auth.login(this.form.value.username, this.form.value.password).subscribe({
      next: () => this.router.navigate(['/dashboard']),
      error: (err) => {
        this.error = err?.error?.message ?? 'Falha no login. Verifique usuário e senha.';
      },
    });
  }
}
