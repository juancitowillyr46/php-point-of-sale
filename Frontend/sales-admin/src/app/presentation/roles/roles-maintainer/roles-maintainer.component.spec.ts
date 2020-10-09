import { async, ComponentFixture, TestBed } from '@angular/core/testing';

import { RolesMaintainerComponent } from './roles-maintainer.component';

describe('RolesMaintainerComponent', () => {
  let component: RolesMaintainerComponent;
  let fixture: ComponentFixture<RolesMaintainerComponent>;

  beforeEach(async(() => {
    TestBed.configureTestingModule({
      declarations: [ RolesMaintainerComponent ]
    })
    .compileComponents();
  }));

  beforeEach(() => {
    fixture = TestBed.createComponent(RolesMaintainerComponent);
    component = fixture.componentInstance;
    fixture.detectChanges();
  });

  it('should create', () => {
    expect(component).toBeTruthy();
  });
});
