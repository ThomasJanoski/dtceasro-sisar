import { CommonModule } from '@angular/common';
import { Component } from '@angular/core';
import { FormBuilder, ReactiveFormsModule, Validators } from '@angular/forms';
import { ActivatedRoute, Router } from '@angular/router';
import { ApiService } from '../services/api.service';

@Component({
  selector: 'caixa-form',
  standalone: true,
  imports: [CommonModule, ReactiveFormsModule],
  template: `
    <section class="form-page">
      <div class="form-card">
        <h2>{{ isEdit ? 'Editar caixa' : 'Adicionar caixa' }}</h2>
        <form [formGroup]="form" (ngSubmit)="submit()">
          <div class="grid"> 
            <label>
              Setor
              <input formControlName="SETOR" />
            </label>
            <label>
              Ano
              <input formControlName="ANO" />
            </label>
            <label>
              Assunto
              <input formControlName="ASSUNTO" />
            </label>
            <label>
              Código
              <input formControlName="CODIGO" />
            </label>
            <label>
              Corrente
              <input formControlName="CORRENTE" />
            </label>
            <label>
              Intermediário
              <input formControlName="INTERMEDIARIO" />
            </label>
            <label>
              Dest. Final
              <input formControlName="DESTFINAL" />
            </label>
            <label>
              Tipo
              <select formControlName="TIPO">
                <option value="Corrente">Corrente</option>
                <option value="INTERMEDIARIO">INTERMEDIARIO</option>
                <option value="ELIMINAÇÃO">ELIMINAÇÃO</option>
                <option value="PERMANENTE">PERMANENTE</option>
              </select>
            </label>
            <label>
              Nº Caixa
              <input type="number" formControlName="NCAIXA" />
            </label>
            <label>
              Estante
              <input type="number" formControlName="ESTANTE" />
            </label>
          </div>

          <div class="actions">
            <button type="submit" [disabled]="form.invalid">Salvar</button>
            <button type="button" class="secondary" (click)="router.navigate(['/dashboard/caixas'])">Cancelar</button>
          </div>
        </form>
      </div>
    </section>
  `,
  styles: [
    `
      .form-page { padding: 1rem; }
      .form-card { background: #fff; border-radius: 20px; box-shadow: 0 16px 40px rgba(30, 50, 80, 0.08); padding: 2rem; }
      h2 { margin: 0 0 1.5rem; }
      .grid { display: grid; gap: 1rem; grid-template-columns: repeat(auto-fit,minmax(220px,1fr)); }
      label { display: flex; flex-direction: column; gap: 0.5rem; font-weight: 600; color: #334155; }
      input, select { width: 100%; padding: 0.85rem 1rem; border-radius: 12px; border: 1px solid #d8e1ec; }
      .actions { margin-top: 1.5rem; display: flex; gap: 0.75rem; flex-wrap: wrap; }
      button { border: none; border-radius: 999px; padding: 0.95rem 1.35rem; font-weight: 700; cursor: pointer; background: #0066cc; color: white; }
      .secondary { background: #f4f6fb; color: #1f2937; }
    `
  ]
})
export class CaixaFormComponent {
  form = this.fb.group({
    SETOR: ['', Validators.required],
    ANO: ['', Validators.required],
    ASSUNTO: ['', Validators.required],
    CODIGO: ['', Validators.required],
    CORRENTE: ['', Validators.required],
    INTERMEDIARIO: ['', Validators.required],
    DESTFINAL: ['', Validators.required],
    TIPO: ['Corrente', Validators.required],
    NCAIXA: [1, [Validators.required, Validators.min(1)]],
    ESTANTE: [1, [Validators.required, Validators.min(1)]],
  });

  id = 0;
  isEdit = false;

  constructor(private fb: FormBuilder, private api: ApiService, private route: ActivatedRoute, public router: Router) {
    const id = Number(this.route.snapshot.paramMap.get('id'));
    if (id) {
      this.id = id;
      this.isEdit = true;
      this.api.getCaixa(id).subscribe((data) => this.form.patchValue(data));
    }
  }

  submit(): void {
    if (this.form.invalid) {
      return;
    }

    const payload = this.form.value;
    const action = this.isEdit ? this.api.updateCaixa(this.id, payload) : this.api.createCaixa(payload);

    action.subscribe({
      next: () => this.router.navigate(['/dashboard/caixas']),
    });
  }
}
