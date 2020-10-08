export interface UserStoreDto {
    id: string;
    email: string;
    username: string;
    password: string;
    firstName: string;
    lastName: string;
    active: boolean;
    roleId: string;
    blocked: boolean;
}
