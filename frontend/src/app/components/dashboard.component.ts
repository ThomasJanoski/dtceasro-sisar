import { Component } from '@angular/core';
import { RouterLink, RouterOutlet } from '@angular/router';
import { AuthService } from '../services/auth.service';

@Component({
  selector: 'dashboard-page',
  standalone: true,
  imports: [RouterLink, RouterOutlet],
  template: `
    <div class="page dashboard-page">
      <header class="topbar">
        <div>
          <span class="brand">SISAR Arquivos</span>
          <span class="subtitle">Bem-vindo, {{ auth.userName }}</span>
        </div>
        <button type="button" (click)="auth.logout()">Sair</button>
      </header>

      <section class="actions">
        <a routerLink="caixas" [queryParams]="{ tipo: 'Corrente' }">Arquivo Corrente</a>
        <a routerLink="caixas" [queryParams]="{ tipo: 'INTERMEDIARIO' }">Intermediário</a>
        <a routerLink="caixas" [queryParams]="{ tipo: 'ELIMINAÇÃO' }">Eliminação</a>
        <a routerLink="caixas" [queryParams]="{ tipo: 'PERMANENTE' }">Permanente</a>
        <a routerLink="caixas/new" class="action-add">Adicionar caixa</a>
      </section>

      <main>
        <router-outlet></router-outlet>
      </main>
    </div>
  `,
  styles: [
    `
      .page { min-height: 100vh; background: #eef2f7; padding: 1.5rem; }
      .topbar { display: flex; justify-content: space-between; align-items: center; gap: 1rem; padding: 1rem 1.5rem; background: white; border-radius: 18px; box-shadow: 0 8px 30px rgba(34, 60, 80, 0.08); }
      .brand { display: block; font-weight: 800; font-size: 1.2rem; }
      .subtitle { margin-left: 0.75rem; color: #556078; }
      .actions { display: flex; flex-wrap: wrap; gap: 0.75rem; margin: 1.25rem 0; }
      .actions a { text-decoration: none; padding: 0.9rem 1.4rem; border-radius: 999px; background: #ffffff; color: #173a5e; border: 1px solid #d5dde6; transition: transform 0.15s ease; }
      .actions a:hover { transform: translateY(-1px); }
      .action-add { background: #0066cc; color: white; }
      main { margin-top: 1rem; }
    `
  ]
})
export class DashboardComponent {
  constructor(public auth: AuthService) {}
}
