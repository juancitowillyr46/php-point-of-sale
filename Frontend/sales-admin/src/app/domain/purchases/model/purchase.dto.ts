export interface PurchaseDto {
    id: string;
    providerId: string;
    providerName: string;
    documentTypeName: string;
    documentTypeId: string;
    documentNumber: string;
    date: string;
    total: number;
    note: string;
    active: boolean;
    createdAtName: string;
    createdAt: string;
    activeName: string;
}
