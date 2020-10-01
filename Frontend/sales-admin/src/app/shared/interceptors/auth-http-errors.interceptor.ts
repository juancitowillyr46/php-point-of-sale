import { HttpErrorResponse, HttpEvent, HttpHandler, HttpInterceptor, HttpRequest } from '@angular/common/http';
import { Injectable } from '@angular/core';
import { Observable, throwError } from 'rxjs';
import { catchError, map } from 'rxjs/operators';

@Injectable()
export class AuthHttpErrorsInterceptor implements HttpInterceptor {

    intercept(request: HttpRequest<any>, next: HttpHandler): Observable<HttpEvent<any>> {
        const that = this;
        return next.handle(request).pipe(catchError((error: HttpErrorResponse) => {
            if(error.status === 401) {
                // TODO: Redirect Login
            } else if(error.status === 403) {
                // TODO: Implementar alertas
            } else {
                // TODO: Implementar alertas
            }
            return  throwError(error);
        }));
    }

}