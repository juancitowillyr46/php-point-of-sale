import { async, ComponentFixture, TestBed } from '@angular/core/testing';

import { GridSimpleComponent } from './grid-simple.component';

describe('GridSimpleComponent', () => {
  let component: GridSimpleComponent;
  let fixture: ComponentFixture<GridSimpleComponent>;

  beforeEach(async(() => {
    TestBed.configureTestingModule({
      declarations: [ GridSimpleComponent ]
    })
    .compileComponents();
  }));

  beforeEach(() => {
    fixture = TestBed.createComponent(GridSimpleComponent);
    component = fixture.componentInstance;
    fixture.detectChanges();
  });

  it('should create', () => {
    expect(component).toBeTruthy();
  });
});
