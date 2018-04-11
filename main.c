#include <stdio.h>

void printVector(int v[], int size) {
    printf("VETOR: ");
    for (int i = 0; i < size; i++) printf("%d ", v[i]);
    printf("\n");
}

void vectorOrder(int v[], int size) {
    int changed = 0;
    do {
        for (int i = 0; i < size - 1; i++) {
            if (v[i] > v[i + 1]) {
                int saveValue = v[i];
                v[i] = v[i + 1];
                v[i + 1] = saveValue;
                changed++;
            }
        }
        if (changed > 0) {
            printVector(v, size);
            changed = 0;
        } else break;
    } while (1);
}

int main() {
    printf("# ANALISE DE ALGORITIMO # \n\n- Metódo bolha para ordenação -\n\n");
    int vector[9] = {2, 6, 4, 5, 1, 20, 6, -4, 29};
    vectorOrder(vector, 9);
    printf("\n##  FIM  ##");
    return 0;
}