import { Directive, ElementRef, HostListener } from '@angular/core';

@Directive({ selector: '[ngOnSelectInput]' })

export class InputSelectDirective {

    constructor(private el: ElementRef) {}

    @HostListener('click', ['$event'])
    onClick(event: KeyboardEvent){
        const that = this;
        that.el.nativeElement.select();
    }
    
}