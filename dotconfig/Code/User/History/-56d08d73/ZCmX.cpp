/******************************************************************************

                              Online C++ Compiler.
               Code, Compile, Run and Debug C++ program online.
Write your code in this editor and press "Run" button to compile and execute it.

*******************************************************************************/

#include <iostream>
#include <bitset>
#include <vector>
#include <algorithm>
#include <random>
#include <string>

using namespace std;

vector<pair<string, vector<int>>> init_population(int pop_size, int nodes)
{
    int max_bits = (int)ceil(log2(nodes)) + 1;
    vector<pair<string, vector<int>>> pop;
    vector<vector<int>> sublists;
    random_device rd;
    mt19937 gen(rd());
    uniform_real_distribution<> dist(0.0, 1.0);

    while (pop.size() < pop_size)
    {
        vector<int> indiv;
        for (int i = 1; i <= nodes; i++)
        {
            indiv.push_back(i);
        }

        random_shuffle(indiv.begin(), indiv.end());
        vector<string> binary_representations;

        for (int integer : indiv)
        {
            binary_representations.push_back(bitset<8>(integer).to_string());
        }
        string joined_string = "";

        for (int i = 0; i < binary_representations.size(); i++)
        {
            joined_string += binary_representations[i];
        }

        vector<int> refr(nodes, 1);

        int sum = 0;
        for (int integer : indiv)
        {
            sum += integer;
        }
        if (sum == nodes)
        {
            pop.push_back({joined_string, indiv});
        }
    }
    return pop;
}

int main()
{
    int pop_size = 5;
    int nodes = 13;
    vector<pair<string, vector<int>>> population = init_population(pop_size, nodes);

    for
        cout << population[0].first;

    return 0;
}