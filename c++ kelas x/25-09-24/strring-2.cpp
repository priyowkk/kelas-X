#include<iostream>
#include<string>

int main() {
    std::string input;

            std::cout << "masukkan sebuah string :";
            std::getline(std::cin,input);

            std::string reversed = std::string(input.rbegin(),input.rend ());

            std::cout <<"string yang dibalik adalah :" <<reversed << std::endl;
            std::cout<< "panjang string adalah :" << input.length() << std::endl;

        return 0;
}
