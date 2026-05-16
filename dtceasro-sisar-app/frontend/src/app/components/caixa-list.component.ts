import { CommonModule } from '@angular/common';
import { Component, computed, effect, signal } from '@angular/core';
import { ActivatedRoute, Router, RouterLink } from '@angular/router';
import { ApiService } from '../services/api.service';

@Component({
  selector: 'caixa-list',
  standalone: true,
  imports: [CommonModule, RouterLink],
  template: `
    <section class="page-content">
      <div class="page-header">
        <h2>Caixas</h2>
        <p *ngIf="tipo()">Filtrando por: {{ tipo() }}</p>
      </div>

      <div *ngIf="loading()" class="loader">Carregando...</div>

      <div *ngIf="!loading() && caixas().length === 0" class="empty-state">
        Nenhuma caixa encontrada para o filtro selecionado.
      </div>

      <div class="cards-grid">
        <article *ngFor="let caixa of caixas()" class="card" [class.card-danger]="caixa.TIPO === 'ELIMINAÇÃO'" [class.card-warning]="caixa.TIPO === 'INTERMEDIARIO'" [class.card-primary]="caixa.TIPO === 'PERMANENTE'" [class.card-success]="caixa.TIPO === 'Corrente'">
          <header>
            <span>{{ caixa.SETOR }}</span>
            <strong>{{ caixa.NCAIXA }}</strong>
          </header>
          <div class="card-body">
            <p><strong>Ano:</strong> {{ caixa.ANO }}</p>
            <p><strong>Assunto:</strong> {{ caixa.ASSUNTO }}</p>
            <p><strong>Código:</strong> {{ caixa.CODIGO }}</p>
            <p><strong>Corrente:</strong> {{ caixa.CORRENTE }}</p>
            <p><strong>Intermediário:</strong> {{ caixa.INTERMEDIARIO }}</p>
            <p><strong>Dest. Final:</strong> {{ caixa.DESTFINAL }}</p>
          </div>
          <footer>
            <a [routerLink]="['/dashboard/caixas', caixa.ID, 'edit']">Editar</a>
            <button type="button" (click)="deleteCaixa(caixa.ID)">Excluir</button>
          </footer>
        </article>
      </div>
    </section>
  `,
  styles: [
    `
      .page-content { padding: 1rem; background: white; border-radius: 20px; }
      .page-header { display: flex; justify-content: space-between; align-items: baseline; gap: 1rem; margin-bottom: 1rem; }
      .cards-grid { display: grid; grid-template-columns: repeat(auto-fit, minmax(250px, 1fr)); gap: 1rem; }
      .card { border-radius: 18px; overflow: hidden; background: #ffffff; border: 1px solid #dee3ea; display: flex; flex-direction: column; }
      .card header { padding: 1rem; display: flex; justify-content: space-between; font-weight: 700; background: rgba(0,0,0,.03); }
      .card-body { padding: 1rem; flex: 1; }
      .card footer { padding: 1rem; display: flex; gap: 0.75rem; justify-content: flex-end; }
      .card a, .card button { border: none; border-radius: 10px; padding: 0.7rem 1rem; background: #f4f6fb; color: #1a2d44; cursor: pointer; text-decoration: none; }
      .card button { background: #e74c3c; color: white; }
      .card.card-danger { border-color: #d9534f; }
      .card.card-warning { border-color: #f0ad4e; }
      .card.card-primary { border-color: #0275d8; }
      .card.card-success { border-color: #28a745; }
      .loader, .empty-state { padding: 2rem; color: #556078; text-align: center; }
    `
  ]
})
export class CaixaListComponent {
  caixas = signal<any[]>([]);
  loading = signal(true);
  tipo = signal('');

  constructor(private api: ApiService, private route: ActivatedRoute, private router: Router) {
    this.route.queryParamMap.subscribe((params) => {
      const tipo = params.get('tipo') ?? '';
      this.tipo.set(tipo);
      this.loadCaixas(tipo);
    });
  }

  loadCaixas(tipo: string): void {
    this.loading.set(true);
    this.api.getCaixas(tipo).subscribe({
      next: (result) => {
        this.caixas.set(result);
        this.loading.set(false);
      },
      error: () => {
        this.caixas.set([]);
        this.loading.set(false);
      },
    });
  }

  deleteCaixa(id: number): void {
    if (!confirm('Deseja excluir esta caixa?')) {
      return;
    }

    this.api.deleteCaixa(id).subscribe({
      next: () => this.loadCaixas(this.tipo()),
    });
  }
}
