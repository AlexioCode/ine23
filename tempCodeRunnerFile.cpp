#include <iostream>
int main()
{
    int  x = 4;
    bool incoming = true;
    switch(x)
    {
        case 3:
            if(incoming == false)
                std::cout<<"x es 3\n";
            else
                break;
            std::cout << "aqui no deberias llegar\n";
    }
    std::cout << "hola\n";
}