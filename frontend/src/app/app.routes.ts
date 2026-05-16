import { Routes } from '@angular/router';
import { LoginComponent } from './components/login.component';
import { DashboardComponent } from './components/dashboard.component';
import { CaixaListComponent } from './components/caixa-list.component';
import { CaixaFormComponent } from './components/caixa-form.component';

export const routes: Routes = [
  { path: '', component: LoginComponent },
  {
    path: 'dashboard',
    component: DashboardComponent,
    children: [
      { path: 'caixas', component: CaixaListComponent },
      { path: 'caixas/new', component: CaixaFormComponent },
      { path: 'caixas/:id/edit', component: CaixaFormComponent },
      { path: '', redirectTo: 'caixas', pathMatch: 'full' },
    ],
  },
  { path: '**', redirectTo: '' },
];
