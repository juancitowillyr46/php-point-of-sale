import { Directive, ElementRef, HostListener, NgModule } from '@angular/core';

@Directive({ selector: '[ngOnSelectInput]' })

export class InputSelectDirective {

    constructor(private el: ElementRef) {}

    @HostListener('click', ['$event'])
    onClick(event: KeyboardEvent){
        const that = this;
        that.el.nativeElement.select();
    }
    
}

@NgModule({
    declarations: [ InputSelectDirective ],
    exports: [ InputSelectDirective ]
})

export class InputSelectDirectiveModule {}