export interface PurchaseDetailStoreDto {
    id?: string;
    purchaseId: string;
    productId: string;
    quantity: number;
    price: number;
    subtotal: number;
    active : boolean;
}
