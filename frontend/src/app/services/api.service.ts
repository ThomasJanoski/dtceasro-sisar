import { HttpClient, HttpParams } from '@angular/common/http';
import { Injectable } from '@angular/core';
import { Observable } from 'rxjs';

@Injectable({ providedIn: 'root' })
export class ApiService {
  private baseUrl = 'http://127.0.0.1:8000/api';

  constructor(private http: HttpClient) {}

  login(username: string, password: string): Observable<any> {
    return this.http.post(`${this.baseUrl}/login`, { username, password });
  }

  getCaixas(tipo?: string): Observable<any[]> {
    let params = new HttpParams();
    if (tipo) {
      params = params.set('tipo', tipo);
    }
    return this.http.get<any[]>(`${this.baseUrl}/caixas`, { params });
  }

  getCaixa(id: number): Observable<any> {
    return this.http.get(`${this.baseUrl}/caixas/${id}`);
  }

  createCaixa(payload: any): Observable<any> {
    return this.http.post(`${this.baseUrl}/caixas`, payload);
  }

  updateCaixa(id: number, payload: any): Observable<any> {
    return this.http.put(`${this.baseUrl}/caixas/${id}`, payload);
  }

  deleteCaixa(id: number): Observable<any> {
    return this.http.delete(`${this.baseUrl}/caixas/${id}`);
  }
}
