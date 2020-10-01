import { HttpErrorResponse, HttpEvent, HttpHandler, HttpInterceptor, HttpRequest } from '@angular/common/http';
import { Injectable } from '@angular/core';
import { Observable, throwError } from 'rxjs';
import { catchError, map } from 'rxjs/operators';

@Injectable()
export class AuthHttpHeaderInterceptor implements HttpInterceptor {

    intercept(request: HttpRequest<any>, next: HttpHandler): Observable<HttpEvent<any>> {
        const that = this;
        if(localStorage.getItem('accessToken') || localStorage.getItem('accessToken') != undefined) {
            let accessToken: string = localStorage.getItem('accessToken');
            let cloneRequest = request.clone({
                setHeaders: {
                    'Content-type': 'application/json',
                    'Authorization': 'Bearer' + accessToken
                }
            });
            return next.handle(cloneRequest);
        }
        return next.handle(request);
    }

}