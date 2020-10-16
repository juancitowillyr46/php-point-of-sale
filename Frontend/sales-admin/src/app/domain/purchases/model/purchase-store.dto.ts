export interface PurchaseStoreDto {
    id: string;
    providerId: string;
    documentTypeId: string;
    documentNumber: string;
    date: string;
    total: number;
    note: string;
    active : boolean;
}
