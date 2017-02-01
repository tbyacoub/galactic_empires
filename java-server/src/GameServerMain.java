/**
 * Created by Calvin on 1/31/2017.
 */

import java.sql.Connection;
import java.sql.DriverManager;
import java.sql.SQLException;
import java.sql.Statement;

public class GameServerMain
{
    // JDBC driver string.
    static final String JDBC_DRIVER = "com.mysql.jdbc.Driver";
    // Database url.
    static final String DB_URL = "jdbc:mysql://localhost:3306";

    // Database username and password.
    static final String DB_USER = "user";
    static final String DB_PASS = "pass";

    public static void main(String[] args)
    {
        // Database connection and query statement.
        Connection db_conn = null;
        Statement stmt = null;

        try
        {
            // Register the driver.
            Class.forName(JDBC_DRIVER);

            // Connect to the database.
            System.out.println("Attempting to open connection to database...");
            db_conn = DriverManager.getConnection(DB_URL, DB_USER, DB_PASS);
            System.out.println("Database connection successful.");

        }
        // If there is an SQL exception...
        catch (SQLException sql_ex)
        {
            sql_ex.printStackTrace();
        }
        // If there are any other exceptions...
        catch (Exception ex)
        {
            // Print the stack trace.
            ex.printStackTrace();
        }
        finally
        {
            // Try to close the database.
            try
            {
                // If the database connection exists...
                if (db_conn != null) {
                    // Close the connection.
                    db_conn.close();

                    System.out.println("Database connection closed.");
                }
            }
            // If there is an exception, print the stack trace.
            catch (SQLException sql_ex2)
            {
                sql_ex2.printStackTrace();
            }
        }

    }
}
