import { async, ComponentFixture, TestBed } from '@angular/core/testing';

import { PermissionsMaintainerComponent } from './permissions-maintainer.component';

describe('PermissionsMaintainerComponent', () => {
  let component: PermissionsMaintainerComponent;
  let fixture: ComponentFixture<PermissionsMaintainerComponent>;

  beforeEach(async(() => {
    TestBed.configureTestingModule({
      declarations: [ PermissionsMaintainerComponent ]
    })
    .compileComponents();
  }));

  beforeEach(() => {
    fixture = TestBed.createComponent(PermissionsMaintainerComponent);
    component = fixture.componentInstance;
    fixture.detectChanges();
  });

  it('should create', () => {
    expect(component).toBeTruthy();
  });
});
