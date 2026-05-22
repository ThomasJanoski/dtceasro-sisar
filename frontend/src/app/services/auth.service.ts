import { Injectable } from '@angular/core';
import { Router } from '@angular/router';
import { ApiService } from './api.service';
import { tap } from 'rxjs';

@Injectable({ providedIn: 'root' })
export class AuthService {
  constructor(private api: ApiService, private router: Router) {}

  login(usuario: string, senha: string) {
    return this.api.login(usuario, senha).pipe(
      tap((result) => {
        localStorage.setItem('auth_token', result.token);
      
        const userName = result.user?.usuario;
        localStorage.setItem('auth_user', userName);
      })
    );
  }

  logout(): void {
    localStorage.removeItem('auth_token');
    localStorage.removeItem('auth_user');
    this.router.navigate(['/']);
  }

  get token(): string | null {
    return localStorage.getItem('auth_token');
  }

  get userName(): string {
    return localStorage.getItem('auth_user') ?? '';
  }

  get isAuthenticated(): boolean {
    return !!this.token;
  }
}
