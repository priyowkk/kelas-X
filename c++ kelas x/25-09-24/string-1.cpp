#include<iostream>
#include<string>

int main() {
    std::string input;

    std::cout << "masukkan sebuah string :";
    std::getline(std::cin,input);

    std::cout<< "panjang string adalah :" << input.length() << std::endl;
    return 0;
}
