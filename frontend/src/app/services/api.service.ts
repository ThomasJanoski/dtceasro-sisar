import { HttpClient, HttpParams, HttpHeaders } from '@angular/common/http';
import { Injectable } from '@angular/core';
import { Observable } from 'rxjs';

@Injectable({ providedIn: 'root' })
export class ApiService {
  private baseUrl: string;

  constructor(private http: HttpClient) {
     const host = window.location.hostname;
    
    // Se estiver no PC local (localhost), usa a porta 8000. 
    // Se estiver no servidor, não usa porta (usa a 443 do Nginx)
    if (host === 'localhost' || host === '127.0.0.1') {
      this.baseUrl = `http://${host}:8000/api`;
    } else {
      // No servidor, usamos o protocolo atual (https) e o host atual
      this.baseUrl = `${window.location.origin}/api`;
    }
  }

  private authHeaders(): { headers?: HttpHeaders } {
    const token = localStorage.getItem('auth_token');
    if (token) {
      return { headers: new HttpHeaders({ 'Authorization': `Bearer ${token}` }) };
    }
    return {};
  }

  login(usuario: string, senha: string): Observable<any> {
    return this.http.post(`${this.baseUrl}/login`, { usuario, senha });
  }

  getCaixas(tipo?: string): Observable<any[]> {
    let params = new HttpParams();
    if (tipo) {
      params = params.set('tipo', tipo);
    }
    return this.http.get<any[]>(`${this.baseUrl}/caixas`, { params, ...this.authHeaders() });
  }

  getCaixa(id: number): Observable<any> {
    return this.http.get(`${this.baseUrl}/caixas/${id}`, this.authHeaders());
  }

  createCaixa(payload: any): Observable<any> {
    return this.http.post(`${this.baseUrl}/caixas`, payload, this.authHeaders());
  }

  updateCaixa(id: number, payload: any): Observable<any> {
    return this.http.put(`${this.baseUrl}/caixas/${id}`, payload, this.authHeaders());
  }

  deleteCaixa(id: number): Observable<any> {
    return this.http.delete(`${this.baseUrl}/caixas/${id}`, this.authHeaders());
  }
}
