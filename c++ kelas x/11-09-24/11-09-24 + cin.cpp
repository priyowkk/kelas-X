#include<iostream>
int main() {
    std::cout << "persegi panjang!" <<std::endl;

    //for (int i= 7; i>=0 ;i--)
       // std::cout << i<< "saya \n";
    for(int i=1;i<=5;++i) {
         for (int j=1;j<=5;++j){
            std::cout << "0";
         }
         std::cout<<std::endl;
    }

    std::cout << "Kata pemrograman Mendatar" << std::endl;

    for (int a=1;a <=5;a++)
        std::cout<<"pemrograman "<< std::endl;

    for (int b=1;b<=3;b++){

            for (int c=1;c<=5;c++) {
                std:: cout  << "[]";
            }
            std::cout<<std::endl;

    }

    int f;
    int n;
    char c;

    std::cout << "masukkan lebar: ";
    std::cin >>f;

     std::cout << "masukkan panjang: ";
     std::cin >>n;

     std::cout << "masukkan karakter :";
     std::cin >>c;

    for (int i=1; i<=f; ++i) {
        for (int j=1; j<=n; ++j) {
           std:: cout<<c;
        }
        std::cout<<std::endl;
    }

        return 0;

}
