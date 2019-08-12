/******************************************************************************

                 Aluno: Ednailson Vilas Boas da Cunha Júnior
                          Matricula: 149131051
         Código escrito para Analise de Algoritimos 2018.1 - UNIFACS

*******************************************************************************/

#include <stdio.h>
#include <stdlib.h>

void printVector(int v[], int size, int position1, int position2, int changed) {
    if (changed == -1) printf("\n");
    else if (changed == -2) printf("\n\nVETOR FINAL DESSA INTERACAOO: ");
    else if (changed == -3) printf("\n## VETOR ORDENADO ##\n\n\n");
    else printf("\nORDENACAO %d: ", changed);
    for (int i = 0; i < size; i++){
        if (i==position1) printf("[");
        printf(" %d ", v[i]);
        if (i==position2) printf("]");
    }
    printf("\n");
}

void vectorOrder(int v[], int size) {
    int changed = 0;
    int control = 0;
    do {
        for (int i = 0; i < size - 1; i++) {
            if (v[i] > v[i + 1]) {
                int saveValue = v[i];
                v[i] = v[i + 1];
                v[i + 1] = saveValue;
                control++;
                printVector(v,size, i, i+1, changed+1);
            }
        }
        if (control > 0) {
            changed++;
            printVector(v, size, -1, -1, -2);
            printf("\n");
            while( getchar() != '\n' );
            system("cls");
            control = 0;
        } else break;
    } while (1);
    printVector(v, size, -1, -1, -3);
}

int main() {
	system("COLOR F0");
    printf("# ANALISE DE ALGORITIMO # \n\n- Metodo bolha para ordenacao -\n");
    printf("\n\n-- VETOR --");
    int vector[9] = {2, 6, 4, 7, 1, 20, 6, -4, 29};
    printVector(vector, 9, -1, -1, -1);
    printf("\n");
    printf("\n@@ ORDENANDO @@\n\n");
    vectorOrder(vector, 9);
    printf("\n\n##  FIM  ##\n\n");
    return 0;
}
